<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://webomnizz.com
 * @since      1.0.0
 *
 * @package    Icj
 * @subpackage Icj/admin
 * @author     Jogesh <jogesh@webomnizz.com>
 */
class Icj_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/icj-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_register_script($this->plugin_name . '-ace', '//cdnjs.cloudflare.com/ajax/libs/ace/1.4.7/ace.js');
		wp_register_script($this->plugin_name . '-ace-mode', '//cdnjs.cloudflare.com/ajax/libs/ace/1.4.7/mode-html.js');
		wp_register_script($this->plugin_name . '-ace-theme', '//cdnjs.cloudflare.com/ajax/libs/ace/1.4.7/theme-github.js');
		wp_register_script($this->plugin_name . '-noty', '//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js');
		wp_register_script($this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/icj-admin.js', array( 'jquery', $this->plugin_name . '-ace', $this->plugin_name . '-ace-mode', $this->plugin_name . '-ace-theme', $this->plugin_name . '-noty' ), $this->version, false );

		wp_localize_script($this->plugin_name, 'ICJ', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ), 
			'action' => $this->plugin_name . '_update_settings', 
			'settings' => icj_settings()->get_option()
		));

		wp_enqueue_script( $this->plugin_name );
	}

	/**
	 * Save Form Data
	 *
	 * @since 1.0.0
	 */
	public function save_settings() {
		
		if ( ! isset( $_POST['icj_field'] ) 
			|| ! wp_verify_nonce( $_POST['icj_field'], 'icj_action' ) 
		) {
			wp_send_json(array('message' => __('Un-Authrized access!', 'icj') ), 401);
			exit;
		} else {

			$header = trim($_POST['header']);
			$footer = trim($_POST['footer']);

			$settings = array('header' => $header, 'footer' => $footer);

			icj_settings()->update_option( $settings );
			$response_message = __('Your requested data saved successfully.', 'icj');

			wp_send_json( array('message' => $response_message));
			exit;
		}
	}
}
