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

class AssetsNinjs{
    function __construct() {
        add_action('plugins_loaded',array($this,'assets'));
    }
    function assets(){
         load_plugin_textdomain('assetsninja',false,plugin_dir_url( __File__ )."/languages");
    }
}
new AssetsNinjs();