<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://webomnizz.com
 * @since      1.0.0
 *
 * @package    Icj_Settings
 * @subpackage Icj_Settings/includes
 * @author     Jogesh <jogesh@webomnizz.com>
 */
class Icj_Settings {

    /**
     * Cache Key
     *
     * @var string
     */
    private $cache_key;

    public function __construct() {

        $this->cacke_key = ICJ_SETTINGS . '__cache';
    }

    /**
     * Get Option value
     *
     * @param string $column_name
     * @return mixed
     */
    public function get_option( $column_name = '' ) {

        $settings_cache = wp_cache_get( $this->cache_key );

        if (! $settings_cache) {
            $settings_cache = \get_option( ICJ_SETTINGS );
            wp_cache_set( $this->cache_key, $settings_cache );
        }
        
        if ( empty($column_name) ) {
            return is_array( $settings_cache ) 
                ? array_map('html_entity_decode', stripslashes_deep( $settings_cache ))
                : html_entity_decode(stripslashes( $settings_cache ));
        }

        return ! empty($column_name) && isset( $settings_cache[$column_name] ) 
            ? html_entity_decode(stripslashes( $settings_cache[$column_name] )) 
            : null;
    }

    /**
     * Update Option data
     *
     * @param mixed $request
     * @return void
     */
    public function update_option( $request ) {

        if (is_array($request)) {
            $request = array_map('htmlentities', $request);
        }
        else {
            $request = \htmlentities($request);
        }

        // Reset Cache
        wp_cache_delete( $this->cacke_key );
        
        \update_option( ICJ_SETTINGS, $request );
    }
}

if (! function_exists('icj_settings')) {

    function icj_settings() {
        return new Icj_Settings;
    }
}