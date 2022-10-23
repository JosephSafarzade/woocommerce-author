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

        add_shortcode ( 'wooa_show_author_social_icons' , array($this,'wooa_show_author_social_icons_render') );

        add_shortcode ( 'wooa_return_author_poster_url' , array($this,'wooa_return_author_poster_url_render') );


        add_shortcode ( 'wooa_show_author_profile_picture' , array($this,'wooa_show_author_profile_picture_render') );

        add_shortcode ( 'wooa_show_author_products' , array($this,'wooa_show_author_products_render') );

    }


    function wooa_author_name_render($atts) :void {

        $atts = shortcode_atts( array(
            'author_id' => '0',
            'container_tag' => 'p'
        ), $atts, 'wooa_show_author_name' );


        $author_name =  apply_filters('wooa_show_author_name' , $atts['author_id'] );

        printf(
            "<%s class='wooa-author-name-container'>%s</%s>" ,
            $atts['container_tag'] ,
            $author_name ,
            $atts['container_tag'] ,
        );

    }




    function wooa_show_author_username_render($atts ) :void {

        $atts = shortcode_atts( array(
            'author_id' => '0',
            'container_tag' => 'p'
        ), $atts, 'wooa_show_author_username' );


        printf(

            "<%s class='wooa-author-username-container'>%s</%s>" ,

            $atts['container_tag'] ,

            apply_filters('wooa_show_author_username' , $atts['author_id']) ,

            $atts['container_tag']
        );

    }



    function wooa_show_author_profession_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => '0',
            'container_tag' => 'p'
        ), $atts, 'wooa_show_author_profession' );


        printf(

            "<%s class='wooa-author-profession-container'>%s</%s>",

            $atts['container_tag'],

            apply_filters('wooa_show_author_profession', $atts['author_id']),

	        $atts['container_tag'],

        );

    }


     function wooa_show_author_description_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => '0',
            'container_tag' => 'p'
        ), $atts, 'wooa_show_author_description' );


         printf(
             "<%s class='wooa-author-description-container'>%s</%s>",
             $atts['container_tag'],
             apply_filters('wooa_show_author_description', $atts['author_id']),
             $atts['container_tag']
         );


     }



    function wooa_show_author_email_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => '0',
            'container_tag' => 'p',
            'linkable'=>'no'
        ), $atts, 'wooa_show_author_email' );


        $author_email = apply_filters('wooa_show_author_email',$atts['author_id']);

        if($atts['linkable'] === 'yes'){

            printf(
                "<a class='wooa-author-email-container' href='%s'>%s</a>",
                'mailto:' . sanitize_email($author_email),
                sanitize_email($author_email),
            );


        }else{

            printf(
                "<%s class='wooa-author-email-container'>%s</%s>",
                $atts['container_tag'],
                sanitize_email($author_email),
                $atts['container_tag'],
            );

        }

    }



    function wooa_show_author_product_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => '0',
        ), $atts, 'wooa_show_author_products' );

        global $wooa_author_products_ids;

        $wooa_author_products_ids = apply_filters('wooa_return_author_products_id' , $atts['author_id'] );


        do_action( 'wooa_show_author_products');

    }




    function wooa_show_author_country_name_render($atts) {

        $atts = shortcode_atts( array(
            'author_id' => '0',
            'container_tag' => 'p'
        ), $atts, 'wooa_show_author_country_name' );


        printf(
            "<%s class='wooa-author-country-container'>%s</%s>" ,
            $atts['container_tag'] ,
            apply_filters('wooa_return_author_country_name' , $atts['author_id'] ) ,
            $atts['container_tag'] ,
        );


    }


    function wooa_show_author_city_name_render($atts) {


        $atts = shortcode_atts( array(
            'author_id' => '0',
            'container_tag' => 'p'
        ), $atts, 'wooa_show_author_city_name' );


        printf(
            "<%s class='wooa-author-city-container'>%s</%s>" ,
            $atts['container_tag'] ,
            apply_filters('wooa_return_author_city_name' , $atts['author_id'] ) ,
            $atts['container_tag'] ,
        );



    }



    function wooa_show_author_country_flag_render($atts) {

        $atts = shortcode_atts( array(
            'author_id' => '0',
            'width' => '50',
            'height' => '50'
        ), $atts, 'wooa_show_author_country_flag' );

        $country_code =  get_post_meta($atts['author_id'] , 'wooa_author_country' , true );

        $country_flag = 'https://countryflagsapi.com/png/' . $country_code ;

        if($atts['width'] != '' && $atts['height'] != ''){

            printf (
                "<img class='wooa-author-country-flag-image' width='%spx' height='%spx' src='%s' >",
                esc_attr($atts['width']) ,
                esc_attr($atts['width']) ,
                $country_flag
            );

        } else{

            printf (
                "<img class='wooa-author-country-flag-image' src='%s' >"
                , $country_flag
            );

        }


    }



    function wooa_show_author_social_icons_render($atts){

        $author_meta = get_post_meta($atts['author_id']);

        for($i=1;$i<100;$i++){

            if( isset( $atts["social_icon_{$i}_name"] ) ){

                $social_name = $atts["social_icon_{$i}_name"];

                $social_url = $author_meta[ "wooa_author_{$social_name}_url" ][0];

                printf(
                        "<a class='wooa-social-icon-link' href='%s' target='_blank' rel='nofollow'>
                                    <span class='wooa-social-icon-container'>
                                        <i class='%s'></i>
                                    </span>
                                </a>" ,
                        $social_url ,
                        $atts["social_icon_{$i}_icon"]
                );

            } else {

                break;

            }

        }

    }



    function wooa_return_author_poster_url_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => '0',
        ), $atts, 'wooa_return_author_poster_url' );

        echo apply_filters('wooa_return_author_poster_url' , $atts['author_id']);

    }



    function wooa_show_author_profile_picture_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => '0',
            'width'=>'50',
            'height'=>'50'
        ), $atts, 'wooa_show_author_profile_picture' );


        $image_url = get_the_post_thumbnail_url($atts['author_id'],'full');

        if ($image_url != false){

            printf(
                '<img class="wooa-author-profile-picture" style="width:%spx;height:%spx;" src="%s">',
                $atts['width'],
                $atts['height'],
                $image_url
            );


        } else {

            _e('No Image Has Been Set For Selected Author' , WOOA_TEXT_DOMAIN);

        }


    }



    function wooa_show_author_products_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => '0',
            'products_columns'=>'50',
            'products_count'=>'10',
            'title_tag' => 'h5'
        ), $atts, 'wooa_show_author_products' );

        $products = wooa_core::load_author_products($atts);

        if (!$products){

            _e('No products has been assigned to this author !' , 'WOOA_TEXT_DOMAIN');

        } else {

            printf('<div class="wooa-author-products-container">');

            wooa_core::generate_author_products_html($products);

            printf('</div>');

        }

    }

}

if (class_exists('wooa_shortcodes')){

    $wooa_shortcodes = new wooa_shortcodes();

}