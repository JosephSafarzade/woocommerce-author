<?php

/**
 * wooa_scripts class.
 *
 * This class is for registering and enqueue of styles and scripts used in our plugin
 *
 * @package wooa_scripts
 * @version 1.0
 *
 */
class wooa_scripts
{

	/**
	 *
	 * Class constructor function which call 'load_admin_scripts' to load script and styles in admin area and call
	 * 'load_scripts' to load script and styles in frontend area
	 *
	 */
    function __construct(){

        add_action( 'admin_enqueue_scripts', array($this , 'load_admin_scripts') );

        add_action( 'wp_enqueue_scripts', array($this , 'load_scripts') );

    }

	/**
	 *
	 * Load script and styles in admin area
	 *
	 * First it will check current page to see if it should load its own script and styles and then start to enqueue
	 * style and scripts
	 *
	 *
	 *
	 * @return void
	 *
	 */

    function load_admin_scripts():void{

        global $current_screen;

        $allowed_screens = array("options-permalink",'woocommerce-author',"product");

        if ( in_array( $current_screen->id , $allowed_screens ) ){


            wp_enqueue_style( 'wooa-admin-style', WOOA_ASSETS_CSS_FOLDER_URL . "/admin-style.css", [] , WOOA_PLUGIN_VERSION , 'all' );

            wp_enqueue_style( 'wooa-select2-style', WOOA_ASSETS_CSS_FOLDER_URL . "/select2.min.css", [] , WOOA_PLUGIN_VERSION , 'all' );

            wp_enqueue_script( 'wooa-admin-script', WOOA_ASSETS_JS_FOLDER_URL . "/scripts.min.js", ['jquery'] , WOOA_PLUGIN_VERSION );

            wp_enqueue_script( 'wooa-select2-script', WOOA_ASSETS_JS_FOLDER_URL . "/select2.full.min.js", ['jquery'] , WOOA_PLUGIN_VERSION );

            if ( !wp_script_is('media-upload') ){

                wp_enqueue_script('media-upload');

            }

            if ( !wp_script_is('thickbox') ){

                wp_enqueue_script('thickbox');

            }


            if ( !wp_script_is('thickbox') ){

                wp_enqueue_script('thickbox');

            }


            if ( !wp_style_is('thickbox') ){

                wp_enqueue_script('thickbox');

            }

        }

    }


	/**
	 *
	 * Load our general style file which we use to style our shortcode and widgets
	 *
	 * @return void
	 */
    function load_scripts():void{

        wp_enqueue_style('wooa-font-awesome' , WOOA_ASSETS_CSS_FOLDER_URL . "/fontawesome.css",[],WOOA_PLUGIN_VERSION,'all');

    }

}

/* Create a clone of wooa_scripts class */
if( class_exists('wooa_scripts') ){

    $wooa_scripts = new wooa_scripts();

}