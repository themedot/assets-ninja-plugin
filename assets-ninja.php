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

define( 'ASN_ASSETS_DIR', plugin_dir_url( __FILE__ ) . '/assets/' );
define( 'ASN_ASSETS_PUBLIC_DIR', plugin_dir_url( __FILE__ ) . "assets/public/" );
define( 'ASN_ASSETS_ADMIN_DIR', plugin_dir_url( __FILE__ ) . "assets/admin/" );

class AssetsNinjs {

    private $version;

    function __construct() {

        $this->version = time();

        add_action( 'init', [ $this, 'asn_init' ] );

        add_action( 'plugins_loaded', [$this, 'load_textdomain'] );
        add_action( 'wp_enqueue_scripts', [$this, 'load_front_assets'] );
        add_action( 'admin_enqueue_scripts', [$this, 'load_admin_assets'] );
    }

    function asn_init() {
        wp_deregister_style('fontawesome-css');
        wp_register_style('fontawesome-css','//pro.fontawesome.com/releases/v5.10.0/css/all.css');
    }

    function load_admin_assets( $hook ) {
        $_hook = get_current_screen();
        // if ( 'edit.php' == $hook && ('page' == $_hook->post_type || 'book' == $_hook->post_type) ) {
        //     wp_enqueue_script( 'asn-admin-js', ASN_ASSETS_ADMIN_DIR . "js/admin.js", ['jquery'], $this->version, true );

        if ( 'edit-tags.php' == $hook && 'category' == $_hook->taxonomy ) {
            wp_enqueue_script( 'asn-admin-js', ASN_ASSETS_ADMIN_DIR . "js/admin.js", ['jquery'], $this->version, true );

        }
    }

    function load_front_assets() {
        wp_enqueue_style( 'asn-main-css', ASN_ASSETS_PUBLIC_DIR . "css/main.css", null, $this->version );

        $js_file = [
            'asn-main-js'    => ['path' => ASN_ASSETS_PUBLIC_DIR . "js/main.js", 'dep' => ['jquery']],
            'asn-another-js' => ['path' => ASN_ASSETS_PUBLIC_DIR . "js/another.js", 'dep' => ['jquery']],
            'asn-more-js'    => ['path' => ASN_ASSETS_PUBLIC_DIR . "js/more.js", 'dep' => ['jquery']],
        ];

        foreach ( $js_file as $handle => $fileinfo ) {
            wp_enqueue_script( $handle, $fileinfo['path'], $fileinfo['dep'], $this->version, true );
        }

        $data = [
            'name' => 'Sadat Himel',
            'url'  => 'www.https.//coderstimes.com',
        ];
        wp_localize_script( 'asn-more-js', 'sitedata', $data );
    }
    function load_textdomain() {
        load_plugin_textdomain( 'assetsninja', false, plugin_dir_url( __File__ ) . "/languages" );
    }
}
new AssetsNinjs();