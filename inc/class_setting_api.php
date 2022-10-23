<?php

class wooa_setting_api
{

    public function __construct(){

        add_action( 'admin_init', array($this,'register_wooa_permalink_setting') );

        add_action( 'admin_init', array($this,'save_wooa_permalink_settings') );

    }


    public function register_wooa_permalink_setting(){


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


    public function render_permalink_setting_section(){

        $example_url = get_site_url() . "/author/sample-author";

        printf("You can set a new slug for WooCommerce Author custom post type detail slug. For example, using <code>'author'</code> would make your author detail links like <code>%s</code>. ",$example_url);

    }


    public function render_permalink_setting_field_input_render(){

        $setting = get_option('wooa_url_slug');

        $value =  isset($setting) ? esc_attr($setting) : '';

        printf('<input type="text" name="wooa_url_slug" class="regular-text code" value="%s">',$value);

    }



    function save_wooa_permalink_settings(){

        if( isset($_POST['permalink_structure']) && isset( $_POST['wooa_url_slug'] ) ){

            if('' == $_POST['wooa_url_slug'] ){

                $_POST['wooa_url_slug'] = "woocommerce-author";

            }

            $wooa_url_slug = wp_unslash( $_POST['wooa_url_slug'] );

            update_option( 'wooa_url_slug',  $wooa_url_slug );

        }

    }

}



if( class_exists('wooa_setting_api') ){

    $wooa_setting_api = new wooa_setting_api();

}