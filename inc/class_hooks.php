<?php


class wooa_hooks
{

    private $wooa_core;

    function __construct(){

        $this->wooa_core = new wooa_core();

        $this->define_hooks();

    }


    function define_hooks(){


        add_filter('wooa_show_author_name' , array($this->wooa_core,'return_author_name_by_id') );

        add_filter('wooa_show_author_username' , array($this->wooa_core,'return_author_username_by_id') );

        add_filter('wooa_show_author_profession' , array($this->wooa_core,'return_author_profession_by_id') );

        add_filter('wooa_show_author_email' , array($this->wooa_core,'return_author_email_by_id') );

        add_filter('wooa_show_author_description' , array($this->wooa_core,'return_author_description_by_id') );

        add_filter('wooa_return_author_products_id' , array($this->wooa_core,'return_author_products_id') );

        add_action('wooa_show_author_products_container' , array($this->wooa_core , 'show_author_products_container') );

        add_action('template_redirect' , array($this->wooa_core,'handle_template_redirect_hook') );

        add_action('wooa_show_author_products' , array($this->wooa_core , 'show_author_product_box') );

        add_filter('wp_title', array($this->wooa_core,'modify_woocommerce_author_detail_title') , 999999 , 3 );

        add_filter('wooa_return_author_country_name' , array($this->wooa_core , 'return_author_country_name') );

        add_filter('wooa_return_author_city_name' , array($this->wooa_core , 'return_author_city_name') );

        add_filter('wooa_show_author_country_flag' , array($this->wooa_core , 'show_author_country_flag') );

        add_filter('wooa_return_author_social_url' , array($this->wooa_core , 'return_author_social_url') , 10, 2 );

        add_filter('wooa_return_author_poster_url' , array($this->wooa_core , 'return_author_poster_url') , 10, 1 );

        add_filter('wooa_return_country_full_name' , array($this->wooa_core , 'return_country_full_name') ,10 , 1 );

        add_filter('wooa_return_author_detail_url' , array($this->wooa_core , 'return_author_detail_url') ,10 , 1 );

        add_filter('wooa_return_product_author_id' , array($this->wooa_core , 'return_product_author_id') , 10 , 1 );

        add_filter('wooa_return_product_author_name' , array($this->wooa_core , 'return_product_author_name') , 10 , 1 );

        add_filter('wooa_return_author_id' , array($this->wooa_core , 'return_author_id') , 10 , 1 );

    }


}

if( class_exists('wooa_hooks') ){

    $wooa_hooks = new wooa_hooks();

}