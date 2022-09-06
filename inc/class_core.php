<?php


class wooa_core
{


    function setup_initial_post_data(int $author_id){

        status_header(200);

        global $post;

        $post = get_post( $author_id, OBJECT );

        setup_postdata( $post );

    }


    function load_author_template_file() : void {

        $template_path = locate_template('wooa-single-woocommerce-author.php') != '' ? locate_template('wooa-single-woocommerce-author.php') :  WOOA_PLUGIN_TEMPLATE_DIR . DIRECTORY_SEPARATOR . 'wooa-single-woocommerce-author.php' ;

        require_once ( $template_path );

        exit ;

    }




    function check_if_author_exist( string $author_name ) : int {

        $args = array(
            'post_type'  => 'woocommerce-author',
            'fields' => 'ids',
            'meta_query' => array(
                array(
                    'key'     => 'wooa_author_username',
                    'value'   => array( $author_name ),
                    'compare' => 'IN',
                ),
            ),
        );


        $posts = get_posts( $args );

        return empty( $posts ) ? 0 : $posts[0] ;

    }



    function get_full_url() : string {

        return   (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ;

    }


    function check_for_right_url_structure(string $url) : bool {

        if ( '' == $url ){

            return false;

        }

        $url = rtrim ($url , "/" );

        $site_url = rtrim ( site_url() , "/" );

        $base_url = basename($url);

        $result = rtrim ( str_replace( $base_url , '' , $url ) , "/" );

        return  $site_url == $result ;

    }





    static function return_all_authors_for_admin_panel_input(){

        $authors = array(
            '0' => 'No Author'
        );

        $args = array(
            'post_type' => 'woocommerce-author',
            'posts_per_page' => -1
        );

        $authors_list = get_posts($args);


        foreach ($authors_list as $author){

            $authors[$author->ID] = $author->post_title;

        }

        return $authors;
    }



    public function show_author_products_container(){

        $template_path = locate_template('wooa-author-products-container.php') != '' ? locate_template('wooa-author-products-container.php') :  WOOA_PLUGIN_TEMPLATE_DIR . DIRECTORY_SEPARATOR . 'wooa-author-products-container.php' ;


        require_once ( $template_path );

        return;

    }



    public function show_author_product_box(){

        global $wooa_author_products_ids;

        $template_path = locate_template('wooa-author-product-box.php') != '' ? locate_template('wooa-author-product-box.php') :  WOOA_PLUGIN_TEMPLATE_DIR . DIRECTORY_SEPARATOR . 'wooa-author-product-box.php' ;

        foreach ($wooa_author_products_ids as $product_id){

            global $post;

            $post = get_post($product_id);

            require($template_path);

            wp_reset_postdata();

        }


    }


}


if( class_exists('wooa_core') ){

    $wooa_core = new wooa_core();

}