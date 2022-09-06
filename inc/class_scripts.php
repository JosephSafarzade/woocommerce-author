<?php

class wooa_scripts
{

    function __construct(){

        add_action( 'admin_enqueue_scripts', array($this , 'load_admin_scripts') );

    }


    function load_admin_scripts(){

        wp_enqueue_style( 'wooa-admin-style', WOOA_ASSETS_CSS_FOLDER_URL . "/admin-style.css", [] , WOOA_PLUGIN_VERSION , 'all' );



    }

}


if( class_exists('wooa_scripts') ){

    $wooa_scripts = new wooa_scripts();

}