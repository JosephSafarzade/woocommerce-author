<?php


class wooa_hooks
{

    private $wooa_core;

    function __construct(){

        $this->wooa_core = new wooa_core();

        $this->define_hooks();



    }


    function define_hooks(){


        add_filter('wooa_show_author_name' , array($this,'return_author_name_by_id') );

        add_filter('wooa_show_author_username' , array($this,'return_author_username_by_id') );

        add_filter('wooa_show_author_profession' , array($this,'return_author_profession_by_id') );

        add_filter('wooa_show_author_email' , array($this,'return_author_email_by_id') );

        add_filter('wooa_show_author_description' , array($this,'return_author_description_by_id') );

        add_filter('wooa_return_author_products_id' , array($this,'return_author_products_id') );

        add_action('wooa_show_author_products_container' , array($this->wooa_core , 'show_author_products_container') );

        add_action('template_redirect' , array($this,'handle_template_redirect_hook') );

        add_action('wooa_show_author_products' , array($this->wooa_core , 'show_author_product_box') );

        add_filter('wp_title', array($this,'modify_woocommerce_author_detail_title') , 999999 , 3 );

    }


    function return_author_name_by_id($author_id)  {

        global $post;

        $author_id = $author_id == '0' || $author_id == '' ? get_post_meta ( $post->ID , 'wooa_product_author_id' , true ) : $author_id;

        return get_post_meta($author_id , 'wooa_author_name' , true );

    }


    function return_author_username_by_id($author_id){

        global $post;

        $author_id = $author_id == '0' || $author_id == '' ? get_post_meta ( $post->ID , 'wooa_product_author_id' , true ) : $author_id;

        return get_post_meta($author_id , 'wooa_author_username' , true );

    }



    function return_author_profession_by_id($author_id){

        global $post;

        $author_id = $author_id == '0' || $author_id == '' ? get_post_meta ( $post->ID , 'wooa_product_author_id' , true ) : $author_id;

        echo get_post_meta($author_id , 'wooa_author_profession' , true );

    }




    function return_author_description_by_id($author_id){

        global $post;

        $author_id = $author_id == '0' || $author_id == '' ? get_post_meta ( $post->ID , 'wooa_product_author_id' , true ) : $author_id;

        echo get_post_meta($author_id , 'wooa_author_description' , true );

    }



    function return_author_email_by_id($author_id){

        global $post;

        $author_id = $author_id == '0' || $author_id == '' ? get_post_meta ( $post->ID , 'wooa_product_author_id' , true ) : $author_id;

        echo get_post_meta($author_id , 'wooa_author_email_address' , true );

    }



    function return_author_products_id( $author_id ){

        global $post;

        $author_id = $author_id == '0' || $author_id == '' ? get_post_meta ( $post->ID , 'wooa_product_author_id' , true ) : $author_id;

        $args = array(
          'post_type' => 'product',
          'posts_per_page' => -1,
          'fields'  => 'ids',
          'meta_query' => array(
            array(
                'key'     => 'wooa_product_author_id',
                'value'   => array( $author_id ),
                'compare' => 'IN',
            ),
          ),
        );

        $products = get_posts($args);

        return !empty($products) ? $products : false ;

    }




    function handle_template_redirect_hook() : void {


        if ( is_404() ){

            $current_url = $this->wooa_core->get_full_url();

            $is_correct_url_structure_loaded = $this->wooa_core->check_for_right_url_structure( $current_url );


            if ( $is_correct_url_structure_loaded ) {

                $author_name = basename($current_url);

                $author_id = $this->wooa_core->check_if_author_exist ( $author_name );

                if( $author_id != 0 ){

                    $this->wooa_core->setup_initial_post_data($author_id);

                    $this->wooa_core->load_author_template_file();

                }


            }


        }

    }





    function modify_woocommerce_author_detail_title($title, $sep, $seplocation){

        global $post;

        if ( $post->post_type == 'woocommerce-author' ) {

            $author_name = get_post_meta( $post->ID , 'wooa_author_name' , 'true' );

            if( $author_name != '' ){

                $new_title = $author_name . " Profile";


            } else {

                $author_username = get_post_meta( $post->ID , 'wooa_author_username' , 'true' );

                $new_title = $author_username != '' ? $author_username . " Profile" : $post->title . " Profile";

            }

            return apply_filters ('wooa_single_author_detail_title' , $new_title , $sep , $seplocation );

        } else {

            return $title;


        }


    }








}

if( class_exists('wooa_hooks') ){

    $wooa_hooks = new wooa_hooks();

}