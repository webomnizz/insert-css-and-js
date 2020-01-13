<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://webomnizz.com
 * @since             1.0.0
 * @package           Icj
 *
 * @wordpress-plugin
 * Plugin Name:       Insert CSS And JavaScript
 * Plugin URI:        https://webomnizz.com
 * Description:       Insert Google Analytics, Facebook Pixel and any related script in WordPress Header or Footer.
 * Version:           1.0.0
 * Author:            Webomnizz
 * Author URI:        https://webomnizz.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       icj
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ICJ_VERSION', '1.0.0' );
define( 'ICJ_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ICJ_SETTINGS', '__icj_data' );


require plugin_dir_path( __FILE__ ) . 'includes/class-icj.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */

icj();
