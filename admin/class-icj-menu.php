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
class Icj_Menu {

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
     * Inject the page in Settings
     * 
     * @since 1.0.0
     */
    public function register_menu() {

        add_submenu_page( 
            'options-general.php', 
            'Insert CSS & JS', 
            'Insert CSS and Javascript', 
            'manage_options', 
            'icj', 
            array($this, 'menu_page_callback')
        );
    }

    /**
     * Plugin Settings Page
     *
     * @since 1.0.0
     */
    public function menu_page_callback() {

        do_action($this->plugin_name . '_admin_before_render');
        do_action($this->plugin_name . '_admin_render');
        do_action($this->plugin_name . '_admin_after_render');
    }
}