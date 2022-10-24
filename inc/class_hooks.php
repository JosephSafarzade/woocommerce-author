<?php

/**
 * wooa_hooks class.
 *
 * This class is created to handle actions and filters in our plugin
 *
 * @package wooa_hooks
 * @version 1.0
 *
 */

class wooa_hooks
{

    private $wooa_core;

	/**
	 *
	 * Class constructor function which create a clone of 'wooa_core' class and then call 'define_hooks' function
	 *
	 *
	 */
    function __construct(){

        $this->wooa_core = new wooa_core();

        $this->define_hooks();

    }


	/**
	 *
	 * Define all actions and filters used in our plugin
	 *
	 * @return void
	 *
	 */
    function define_hooks():void{


        add_filter('wooa_show_author_name' , array($this->wooa_core,'return_author_name_by_id') );

        add_filter('wooa_show_author_username' , array($this->wooa_core,'return_author_username_by_id') );

        add_filter('wooa_show_author_profession' , array($this->wooa_core,'return_author_profession_by_id') );

        add_filter('wooa_show_author_email' , array($this->wooa_core,'return_author_email_by_id') );

        add_filter('wooa_show_author_description' , array($this->wooa_core,'return_author_description_by_id') );

        add_filter('wooa_return_author_products_id' , array($this->wooa_core,'return_author_products_id') );

        add_action('template_redirect' , array($this->wooa_core,'handle_template_redirect_hook') );

        add_filter('wp_title', array($this->wooa_core,'modify_woocommerce_author_detail_title') , 999999 , 3 );

        add_filter('wooa_return_author_country_name' , array($this->wooa_core , 'return_author_country_name') );

        add_filter('wooa_return_author_city_name' , array($this->wooa_core , 'return_author_city_name') );

        add_filter('wooa_show_author_country_flag' , array($this->wooa_core , 'show_author_country_flag') );

        add_filter('wooa_return_author_social_url' , array($this->wooa_core , 'return_author_social_url') , 10, 2 );

        add_filter('wooa_return_author_poster_url' , array($this->wooa_core , 'return_author_poster_url') , 10, 1 );

        add_filter('wooa_return_country_full_name' , array($this->wooa_core , 'return_country_full_name') ,10 , 1 );

        add_filter('wooa_return_author_detail_url' , array($this->wooa_core , 'return_author_detail_url') ,10 , 1 );

        add_filter('wooa_return_author_id' , array($this->wooa_core , 'return_author_id') , 10 , 1 );

    }


}

/* Create a clone of wooa_hooks class */
if( class_exists('wooa_hooks') ){

    $wooa_hooks = new wooa_hooks();

}