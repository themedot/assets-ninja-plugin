<?php

/*
Plugin Name: AssetsNinja
Plugin URI: http://example.com/
Description: Assets Management In Depth
Version: 1.0
Author: sadatHimel
Author URI: http://example.com/
License: GPLv2 or later
Text Domain: assetsninja
Domain Path: /languages
 */

define( 'ASN_ASSETS_DIR', plugin_dir_url( __FILE__ ) . '/assets' );
define( 'ASN_ASSETS_PUBLIC_DIR', plugin_dir_url( __FILE__ ) . "/assets/public" );
define( 'ASN_ASSETS_ADMIN_DIR', plugin_dir_url( __FILE__ ) . "/assets/admin" );

class AssetsNinjs {

    private $version;

    function __construct() {

        $this->version = time();

        add_action( 'plugins_loaded', [$this, 'load_textdomain'] );
        add_action( 'wp_enqueue_scripts', [$this, 'load_front_assets'] );
    }

    function load_front_assets() {
        wp_enqueue_style( 'asn-main-css', ASN_ASSETS_PUBLIC_DIR . "css/main.css", null, $this->version );
        wp_enqueue_script( 'asn-main-js', ASN_ASSETS_PUBLIC_DIR . "js/main.js", ['jquery'], $this->version, true );
        wp_enqueue_script( 'asn-another-js', ASN_ASSETS_PUBLIC_DIR . "js/another.js", ['jquery'], $this->version, true );
    }
    function load_textdomain() {
        load_plugin_textdomain( 'assetsninja', false, plugin_dir_url( __File__ ) . "/languages" );
    }
}
new AssetsNinjs();