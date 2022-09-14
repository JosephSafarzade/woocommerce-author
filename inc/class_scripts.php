<?php

class wooa_scripts
{

    function __construct(){

        add_action( 'admin_enqueue_scripts', array($this , 'load_admin_scripts') );

    }


    function load_admin_scripts(){

        global $current_screen;


        if ($current_screen->id != 'woocommerce-author' ){

            return;

        }

        wp_enqueue_style( 'wooa-admin-style', WOOA_ASSETS_CSS_FOLDER_URL . "/admin-style.css", [] , WOOA_PLUGIN_VERSION , 'all' );

        wp_enqueue_style( 'wooa-select2-style', WOOA_ASSETS_CSS_FOLDER_URL . "/select2.min.css", [] , WOOA_PLUGIN_VERSION , 'all' );

        wp_enqueue_script( 'wooa-select2-script', WOOA_ASSETS_JS_FOLDER_URL . "/select2.full.min.js", ['jquery'] , WOOA_PLUGIN_VERSION );

        wp_enqueue_script( 'wooa-admin-script', WOOA_ASSETS_JS_FOLDER_URL . "/scripts.js", ['jquery'] , WOOA_PLUGIN_VERSION );


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


if( class_exists('wooa_scripts') ){

    $wooa_scripts = new wooa_scripts();

}