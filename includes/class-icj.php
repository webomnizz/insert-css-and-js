<?php

/**
 * The file that defines the core plugin class
 *
 * @link       https://webomnizz.com
 * @since      1.0.0
 *
 * @package    Icj
 * @subpackage Icj/includes
 * @author     Jogesh <jogesh@webomnizz.com>
 */
class Icj {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Icj_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ICJ_VERSION' ) ) {
			$this->version = ICJ_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'icj';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-icj-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-icj-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-icj-settings.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-icj-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-icj-menu.php';
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-icj-public.php';

		$this->loader = new Icj_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Icj_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Icj_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$icj_admin 	= new Icj_Admin( $this->get_plugin_name(), $this->get_version() );
		$icj_menu	= new Icj_Menu( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $icj_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $icj_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $icj_menu, 'register_menu' );
		$this->loader->add_action( 'wp_ajax_' . $this->get_plugin_name() . '_update_settings', $icj_admin, 'save_settings' );

		$this->loader->add_action( $this->get_plugin_name() . '_admin_render', $this, 'admin_dashboard' );
	}

	public function admin_dashboard() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/icj-admin-display.php';
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$icj_public = new Icj_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_head', $icj_public, 'handle_header_hook' );
		$this->loader->add_action( 'wp_footer', $icj_public, 'handle_footer_hook' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

if (! function_exists('icj')) {

	function icj() {

		$plugin = new Icj();
		$plugin->run();
	}
}