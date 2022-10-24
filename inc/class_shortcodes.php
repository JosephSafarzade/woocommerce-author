<?php


class wooa_shortcodes
{

    function __construct(){

        $this->add_shortcodes();

    }


	/**
	 * Register woocommerce author shortcodes
	 *
	 * in this function we will register all required shortcode to display different property of each author
	 * these shortcodes can be used in single author post or any other page by using different author id
	 *
	 *
	 * @return void
	 * @access private
	 */

    private function add_shortcodes(){

        add_shortcode ( 'wooa_show_author_name' , array($this,'wooa_author_name_render') );

        add_shortcode ( 'wooa_show_author_username' , array($this,'wooa_show_author_username_render') );

        add_shortcode ( 'wooa_show_author_profession' , array($this,'wooa_show_author_profession_render') );

        add_shortcode ( 'wooa_show_author_description' , array($this,'wooa_show_author_description_render') );

        add_shortcode ( 'wooa_show_author_email' , array($this,'wooa_show_author_email_render') );

        add_shortcode ( 'wooa_show_author_country_name' , array($this,'wooa_show_author_country_name_render') );

        add_shortcode ( 'wooa_show_author_city_name' , array($this,'wooa_show_author_city_name_render') );

        add_shortcode ( 'wooa_show_author_country_flag' , array($this,'wooa_show_author_country_flag_render') );

        add_shortcode ( 'wooa_show_author_social_icons' , array($this,'wooa_show_author_social_icons_render') );

        add_shortcode ( 'wooa_return_author_poster_url' , array($this,'wooa_return_author_poster_url_render') );

        add_shortcode ( 'wooa_show_author_profile_picture' , array($this,'wooa_show_author_profile_picture_render') );

        add_shortcode ( 'wooa_show_author_products' , array($this,'wooa_show_author_products_render') );

    }



	/**
	 * Render woocommerce author name
	 *
	 * Use to show author full name ( metadata provided when creating author by site admin )
	 *
	 * @param array $atts Array which contain shortcode attribute
	 *      $atts = [
	 *          'author_id' => (string) ID of author which you want to fetch data , set 0 or empty to return current author. Default : 0
	 *          'container_tag' => (string) the html tag which should be used to wrap the provided data between. Default : p
	 *      ]
	 *
	 * @return void
	 * @access public
	 */
    function wooa_author_name_render($atts) :void {

        $atts = shortcode_atts( array(
            'author_id' => apply_filters('wooa_return_author_id','0' ),
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



	/**
	 * Render woocommerce author username
	 *
	 * Use to show author username ( metadata provided when creating author by site admin )
	 *
	 * @param array $atts Array which contain shortcode attribute
	 *      $atts = [
	 *          'author_id' => (string) ID of author which you want to fetch data , set 0 or empty to return current author. Default : 0
	 *          'container_tag' => (string) the html tag which should be used to wrap the provided data between. Default : p
	 *      ]
	 *
	 * @return void
	 * @access public
	 */
    function wooa_show_author_username_render($atts ) :void {

        $atts = shortcode_atts( array(
            'author_id' => apply_filters('wooa_return_author_id','0' ),
            'container_tag' => 'p'
        ), $atts, 'wooa_show_author_username' );


        printf(

            "<%s class='wooa-author-username-container'>%s</%s>" ,

            $atts['container_tag'] ,

            apply_filters('wooa_show_author_username' , $atts['author_id']) ,

            $atts['container_tag']
        );

    }



	/**
	 * Render woocommerce author profession
	 *
	 * Use to show author profession ( metadata provided when creating author by site admin )
	 *
	 * @param array $atts Array which contain shortcode attribute
	 *      $atts = [
	 *          'author_id' => (string) ID of author which you want to fetch data , set 0 or empty to return current author. Default : 0
	 *          'container_tag' => (string) the html tag which should be used to wrap the provided data between. Default : p
	 *      ]
	 *
	 * @return void
	 * @access public
	 */
    function wooa_show_author_profession_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => apply_filters('wooa_return_author_id','0' ),
            'container_tag' => 'p'
        ), $atts, 'wooa_show_author_profession' );


        printf(

            "<%s class='wooa-author-profession-container'>%s</%s>",

            $atts['container_tag'],

            apply_filters('wooa_show_author_profession', $atts['author_id']),

	        $atts['container_tag'],

        );

    }


	/**
	 * Render woocommerce author description
	 *
	 * Use to show author description ( metadata provided when creating author by site admin )
	 *
	 * @param array $atts Array which contain shortcode attribute
	 *      $atts = [
	 *          'author_id' => (string) ID of author which you want to fetch data , set 0 or empty to return current author. Default : 0
	 *          'container_tag' => (string) the html tag which should be used to wrap the provided data between. Default : p
	 *      ]
	 *
	 * @return void
	 * @access public
	 */
     function wooa_show_author_description_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => apply_filters('wooa_return_author_id','0' ),
            'container_tag' => 'p'
        ), $atts, 'wooa_show_author_description' );




         printf(
             "<%s class='wooa-author-description-container'>%s</%s>",
             $atts['container_tag'],
             apply_filters('wooa_show_author_description', $atts['author_id']),
             $atts['container_tag']
         );


     }


	/**
	 * Render woocommerce author email address
	 *
	 * Use to show author email ( metadata provided when creating author by site admin ) , also have an option to set it
	 * clickable so email app will shows up when user click on it
	 *
	 * @param array $atts Array which contain shortcode attribute
	 *      $atts = [
	 *          'author_id' => (string) ID of author which you want to fetch data , set 0 or empty to return current author. Default : 0
	 *          'container_tag' => (string) the html tag which should be used to wrap the provided data between. Default : p ( ignored when linkable set to yes )
	 *          'linkable' => (string) wrap the provided email address in a tag so email app will pop up when user click on email address
	 *      ]
	 *
	 * @return void
	 * @access public
	 */
    function wooa_show_author_email_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => apply_filters('wooa_return_author_id','0' ),
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






	/**
	 * Render woocommerce author country
	 *
	 * Use to show author country name ( metadata provided when creating author by site admin )
	 *
	 * @param array $atts Array which contain shortcode attribute
	 *      $atts = [
	 *          'author_id' => (string) ID of author which you want to fetch data , set 0 or empty to return current author. Default : 0
	 *          'container_tag' => (string) the html tag which should be used to wrap the provided data between. Default : p
	 *      ]
	 *
	 * @return void
	 * @access public
	 */
    function wooa_show_author_country_name_render($atts) {

        $atts = shortcode_atts( array(
            'author_id' => apply_filters('wooa_return_author_id','0' ),
            'container_tag' => 'p'
        ), $atts, 'wooa_show_author_country_name' );


        printf(
            "<%s class='wooa-author-country-container'>%s</%s>" ,
            $atts['container_tag'] ,
            apply_filters('wooa_return_author_country_name' , $atts['author_id'] ) ,
            $atts['container_tag'] ,
        );


    }



	/**
	 * Render woocommerce author city
	 *
	 * Use to show author city name ( metadata provided when creating author by site admin )
	 *
	 * @param array $atts Array which contain shortcode attribute
	 *      $atts = [
	 *          'author_id' => (string) ID of author which you want to fetch data , set 0 or empty to return current author. Default : 0
	 *          'container_tag' => (string) the html tag which should be used to wrap the provided data between. Default : p
	 *      ]
	 *
	 * @return void
	 * @access public
	 */
    function wooa_show_author_city_name_render($atts) {


        $atts = shortcode_atts( array(
            'author_id' => apply_filters('wooa_return_author_id','0' ),
            'container_tag' => 'p'
        ), $atts, 'wooa_show_author_city_name' );


        printf(
            "<%s class='wooa-author-city-container'>%s</%s>" ,
            $atts['container_tag'] ,
            apply_filters('wooa_return_author_city_name' , $atts['author_id'] ) ,
            $atts['container_tag'] ,
        );



    }


	/**
	 * Render woocommerce author country flag
	 *
	 * Use to show a png image of assigned country to the author with specific width and height
	 *
	 * @param array $atts Array which contain shortcode attribute
	 *      $atts = [
	 *          'author_id' => (string) ID of author which you want to fetch data , set 0 or empty to return current author. Default : 0
	 *          'width' => (int) the width of png file in pixel without any prefix or appendix. Default : ''
	 *          'height' => (int) the height of png file in pixel without any prefix or appendix. Default : ''
	 *      ]
	 *
	 * @return void
	 * @access public
	 */
    function wooa_show_author_country_flag_render($atts) {

        $atts = shortcode_atts( array(
            'author_id' => apply_filters('wooa_return_author_id','0' ) ,
            'width' => '',
            'height' => ''
        ), $atts, 'wooa_show_author_country_flag' );



        $country_code =  get_post_meta($atts['author_id'] , 'wooa_author_country' , true );

        $country_flag = 'https://countryflagsapi.com/png/' . $country_code ;

        if($atts['width'] != '' && $atts['height'] != ''){

            printf (
                "<img class='wooa-author-country-flag-image' width='%spx' height='%spx' src='%s' >",
                esc_attr($atts['width']) ,
                esc_attr($atts['height']) ,
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



	/**
	 * Render woocommerce author poster url
	 *
	 * Use to show author poster image url ( metadata provided when creating author by site admin )
	 *
	 * @param array $atts Array which contain shortcode attribute
	 *      $atts = [
	 *          'author_id' => (string) ID of author which you want to fetch data , set 0 or empty to return current author. Default : 0
	 *      ]
	 *
	 * @return void
	 * @access public
	 */
    function wooa_return_author_poster_url_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => apply_filters('wooa_return_author_id','0' ),
        ), $atts, 'wooa_return_author_poster_url' );

        echo apply_filters('wooa_return_author_poster_url' , $atts['author_id']);

    }




	/**
	 * Render woocommerce author profile picture
	 *
	 * show an image which has been set as feature image of author custom post type
	 *
	 * @param array $atts Array which contain shortcode attribute
	 *		$atts = [
	 *          'author_id' => (string) ID of author which you want to fetch data , set 0 or empty to return current author. Default : 0
	 *          'width' => (int) the width of png file in pixel without any prefix or appendix. Default : ''
	 *          'height' => (int) the height of png file in pixel without any prefix or appendix. Default : ''
	 *      ]
	 *
	 * @return void
	 * @access public
	 */
    function wooa_show_author_profile_picture_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => apply_filters('wooa_return_author_id','0' ),
            'width'=>'',
            'height'=>''
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



	/**
	 * Render woocommerce author assigned products
	 *
	 * get list all products assigned to specific author and then render their boxes so user can click and see the product detail
	 *
	 * @param array $atts Array which contain shortcode attribute
	 *		$atts = [
	 *          'author_id' => (string) ID of author which you want to fetch data , set 0 or empty to return current author. Default : 0
	 *          'product_columns' => (int) number of columns in products grid . default : 5
	 *          'products_count' => (int) number of products to show in products grid . default : 10
	 *          'title_tag' => (string) the html tag which we wrap the product title in it. Default : 'h5'
	 *      ]
	 *
	 * @return void
	 * @access public
	 */
    function wooa_show_author_products_render($atts){

        $atts = shortcode_atts( array(
            'author_id' => apply_filters('wooa_return_author_id','0' ),
            'products_columns'=>'5',
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