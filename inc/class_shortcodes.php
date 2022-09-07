<?php


class wooa_shortcodes
{

    function __construct(){

        $this->add_shortcodes();

    }


    function add_shortcodes(){

        add_shortcode ( 'wooa_show_author_name' , array($this,'wooa_author_name_render') );

        add_shortcode ( 'wooa_show_author_username' , array($this,'wooa_show_author_username_render') );

        add_shortcode ( 'wooa_show_author_profession' , array($this,'wooa_show_author_profession_render') );

        add_shortcode ( 'wooa_show_author_description' , array($this,'wooa_show_author_description_render') );

        add_shortcode ( 'wooa_show_author_email' , array($this,'wooa_show_author_email_render') );

        add_shortcode ( 'wooa_show_author_products' , array($this,'wooa_show_author_product_render') );

        add_shortcode ( 'wooa_show_author_country_name' , array($this,'wooa_show_author_country_name_render') );

        add_shortcode ( 'wooa_show_author_city_name' , array($this,'wooa_show_author_city_name_render') );

        add_shortcode ( 'wooa_show_author_country_flag' , array($this,'wooa_show_author_country_flag_render') );

    }


    function wooa_author_name_render($atts) :void {

        $atts = shortcode_atts( array(
            'author_id' => '0',
        ), $atts, 'wooa_show_author_name' );

        echo apply_filters('wooa_show_author_name' , $atts['author_id'] );

    }




    function wooa_show_author_username_render($atts ) :void {

        $atts = shortcode_atts( array(
            'author_id' => '0',
        ), $atts, 'wooa_show_author_username' );

        echo apply_filters('wooa_show_author_username' , $atts['author_id'] );

    }



    function wooa_show_author_profession_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => '0',
        ), $atts, 'wooa_show_author_profession' );

        echo apply_filters('wooa_show_author_profession' , $atts['author_id'] );

    }


     function wooa_show_author_description_render($atts){

            $atts = shortcode_atts( array(
                'author_id' => '0',
            ), $atts, 'wooa_show_author_description' );

            echo apply_filters('wooa_show_author_description' , $atts['author_id'] );

     }



    function wooa_show_author_email_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => '0',
        ), $atts, 'wooa_show_author_email' );

        echo apply_filters('wooa_show_author_email' , $atts['author_id'] );

    }



    function wooa_show_author_product_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => '0',
        ), $atts, 'wooa_show_author_products' );

        global $wooa_author_products_ids;

        $wooa_author_products_ids = apply_filters('wooa_return_author_products_id' , $atts['author_id'] );

        do_action( 'wooa_show_author_products_container');

    }




    function wooa_show_author_country_name_render($atts) {

        $atts = shortcode_atts( array(
            'author_id' => '0',
        ), $atts, 'wooa_show_author_country_name' );

        echo apply_filters('wooa_return_author_country_name' , $atts['author_id'] );

    }


    function wooa_show_author_city_name_render($atts) {

        $atts = shortcode_atts( array(
            'author_id' => '0',
        ), $atts, 'wooa_show_author_city_name' );

        echo apply_filters('wooa_return_author_city_name' , $atts['author_id'] );

    }



    function wooa_show_author_country_flag_render($atts) {

        $atts = shortcode_atts( array(
            'author_id' => '0',
        ), $atts, 'wooa_show_author_country_flag' );

        echo apply_filters('wooa_show_author_country_flag' , $atts['author_id'] );

    }





}

if (class_exists('wooa_shortcodes')){

    $wooa_shortcodes = new wooa_shortcodes();

}