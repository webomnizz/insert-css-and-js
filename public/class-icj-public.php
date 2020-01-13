<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://webomnizz.com
 * @since      1.0.0
 *
 * @package    Icj
 * @subpackage Icj/public
 * @author     Jogesh <jogesh@webomnizz.com>
 */
class Icj_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Invoke with wp_head hook
	 *
	 * @return void
	 */
	public function handle_header_hook() {

		$header = icj_settings()->get_option( 'header' );

		if (! empty($header)) { ?>
			<?php echo $header; ?>
			<?php
		}
	}

	/**
	 * Invoke with wp_footer hook
	 *
	 * @return void
	 */
	public function handle_footer_hook() {

		$footer = icj_settings()->get_option( 'footer' );

		if (! empty($footer)) { ?>
			<?php echo $footer; ?>
			<?php
		}
	}
}
