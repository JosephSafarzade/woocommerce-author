<?php
/**
Plugin Name: WooCommerce Author
Plugin URI:
Description: To create author post type and assign an author to a product , very useful for digital product platforms
Version: 1.0
Author: Joseph Safarzade
License: GPLv2 or later
Text Domain: woocommerce-author
*/

if( !function_exists('get_plugin_data') ){
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$plugin_data = get_plugin_data( __FILE__ );

define('WOOA_PLUGIN_VERSION' , $plugin_data['Version']);

define('WOOA_TEXT_DOMAIN' , $plugin_data['TextDomain'] );

define('WOOA_PLUGIN_DIR' , __DIR__ );

define('WOOA_PLUGIN_TEMPLATE_DIR' , WOOA_PLUGIN_DIR . DIRECTORY_SEPARATOR . "templates" );

define('WOOA_PLUGIN_INC_DIR' , WOOA_PLUGIN_DIR . DIRECTORY_SEPARATOR  . "inc");

define('WOOA_PLUGIN_DIR_URL' , plugin_dir_url( __FILE__ ) );

define('WOOA_ASSETS_FOLDER_URL' , WOOA_PLUGIN_DIR_URL . "/assets" );

define('WOOA_ASSETS_CSS_FOLDER_URL' , WOOA_ASSETS_FOLDER_URL . "/css" );

define('WOOA_ASSETS_JS_FOLDER_URL' , WOOA_ASSETS_FOLDER_URL . "/js" );

define('WOOA_ASSETS_MEDIA_FOLDER_URL' , WOOA_ASSETS_FOLDER_URL . "/media" );

define('WOOA_ASSETS_WEBFONT_FOLDER_URL' , WOOA_ASSETS_FOLDER_URL . "/webfonts" );



require_once (WOOA_PLUGIN_INC_DIR . "/framework.php");