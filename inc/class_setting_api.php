<?php

/**
 * wooa_setting_api class.
 *
 * This class is for registering a setting in wordpress setting api to save our custom post type URL slug
 *
 * @package wooa_setting_api
 * @version 1.0
 *
 */
class wooa_setting_api
{

	/**
	 *
	 * Class constructor function to call 'register_wooa_permalink_setting' and 'save_wooa_permalink_settings' on
	 * 'admin_init' action
	 *
	 */
    public function __construct(){

        add_action( 'admin_init', array($this,'register_wooa_permalink_setting') );

        add_action( 'admin_init', array($this,'save_wooa_permalink_settings') );

    }


	/**
	 *
	 * Register our setting
	 *
	 * First we register a setting named 'wooa_url_slug' , then we add a setting section on wordpress permalink setting
	 * panel , then we add our setting field to that registered section
	 *
	 * @return void
	 */
    public function register_wooa_permalink_setting():void{


        register_setting(
            'permalink',
            'wooa_url_slug',
            array(
                "type"=>"string",
                "description"=>__('Choose a proper name which you want to show in author detail url',WOOA_TEXT_DOMAIN),
                "default" => 'woocommerce-author',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );


        add_settings_section(
            'wooa_permalink_setting',
            'WooCommerce Author Permalink Setting',
            array($this,'render_permalink_setting_section'),
            'permalink'
        );


        add_settings_field(
            'wooa_author_detail_url_slug',
            'Author Detail Slug',
            array($this,'render_permalink_setting_field_input_render'),
            'permalink',
            'wooa_permalink_setting'
        );


    }


	/**
	 *
	 * Render the html content of our setting section ( use to show a brief description about our setting )
	 *
	 * @return void
	 */
    public function render_permalink_setting_section():void{

        $example_url = get_site_url() . "/author/sample-author";

        printf("You can set a new slug for WooCommerce Author custom post type detail slug. For example, using <code>'author'</code> would make your author detail links like <code>%s</code>. ",$example_url);

    }


	/**
	 *
	 * Render our html input which is responsible to get the value from user for custom url slug of 'woocommerce-author'
	 * post type
	 *
	 * @return void
	 *
	 */
    public function render_permalink_setting_field_input_render():void{

        $setting = get_option('wooa_url_slug');

        $value =  isset($setting) ? esc_attr($setting) : '';

        printf('<input type="text" name="wooa_url_slug" class="regular-text code" value="%s">',$value);

    }


	/**
	 *
	 * Save entered value for custom url slug
	 *
	 * It will check if we are saving procedure of permalink setting by checking $_POST['permalink_structure'] and then
	 * it will save our custom URL slug of 'woocomemrce-author' post in 'wooa_url_slug' option to use in registering
	 * custom post type
	 *
	 * @return void
	 *
	 */
    function save_wooa_permalink_settings():void{

        if( isset($_POST['permalink_structure']) && isset( $_POST['wooa_url_slug'] ) ){

            if('' == $_POST['wooa_url_slug'] ){

                $_POST['wooa_url_slug'] = "woocommerce-author";

            }

            $wooa_url_slug = wp_unslash( $_POST['wooa_url_slug'] );

            update_option( 'wooa_url_slug',  $wooa_url_slug );

        }

    }

}


/* Creating a clone of wooa_setting_api class */
if( class_exists('wooa_setting_api') ){

    $wooa_setting_api = new wooa_setting_api();

}