<?php

/**
 *
 * Class to register and show our setting meta box in product and woocommerce author post type editing panel
 *
 * @package wooa_meta_boxes
 * @version 1.0
 *
 */
class wooa_meta_boxes
{

    private $wooa_admin_inputs;


	/**
	 *
	 * Class constructor class which call 'create_woocommerce_author_info_metabox' on 'add_meta_boxes' action to
	 * register our meta boxes and then call 'save_woocommerce_author_info_metabox' and
	 * 'save_woocommerce_assign_author_metabox' to have function to handle saving procedure our
	 * custom meta boxes data , also we create a clone of 'wooa_admin_inputs' class to handle html rendering of our
	 * meta boxes inputs
	 *
	 */
    public function __construct(){

        add_action( 'add_meta_boxes', array( $this, 'create_woocommerce_author_info_metabox' ) );

        add_action( 'save_post',  array( $this, 'save_woocommerce_author_info_metabox' ) );

        add_action( 'save_post',  array( $this, 'save_woocommerce_assign_author_metabox' ) );

        $this->wooa_admin_inputs = new wooa_admin_inputs();

    }


	/**
	 *
	 * Register our meta boxes
	 *
	 * Here we check the post type that we are in and then if it's 'woocommerce-author' or 'product' then we register
	 * our meta boxes for those post types
	 *
	 * @param $post_type string type of the post we are editing
	 *
	 * @return void
	 * @access public
	 *
	 *
	 */
    function create_woocommerce_author_info_metabox($post_type):void {

        if ( 'woocommerce-author' == $post_type ){

            add_meta_box(
                'woocommerce_author_metabox',
                __( 'WooCommerce Author Info', WOOA_TEXT_DOMAIN ),
                array( $this, 'render_woocommerce_author_info_metabox' ),
                $post_type,
                'advanced',
                'high'
            );

        }


        if ( 'product' == $post_type ){

            add_meta_box(
                'woocommerce_assign_author_metabox',
                __( 'Assign Author To Product', WOOA_TEXT_DOMAIN ),
                array( $this, 'render_woocommerce_assign_author_metabox' ),
                $post_type,
                'advanced',
                'high'
            );

        }

    }


	/**
	 *
	 * Render 'woocommerce-author' post type meta box
	 *
	 * Here we first get current post meta data to pass them to our inputs , then we will create multiple inputs by
	 * using 'wooa_admin_input' class functions
	 *
	 * @see wooa_admin_inputs::render_admin_input()
	 *
	 * @return void
	 * @access public
	 *
	 */
    function render_woocommerce_author_info_metabox():void{

        $values = isset($_GET['post']) && $_GET['post'] != ''  ? get_post_meta( $_GET['post']  ) : [];

        wp_nonce_field( 'wooa_author_info_metabox', 'wooa_author_info_metabox' );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'check_elementor',
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textbox',
                'name'=>'wooa_author_username',
                'class' => '',
                'label'=>'Author Username',
                'id' => 'wooa_author_username',
                'placeholder' => 'Author Username',
                'value' => isset($values['wooa_author_username']) && $values['wooa_author_username'][0] != '' ? $values['wooa_author_username'][0] : ''
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textbox',
                'name'=>'wooa_author_name',
                'class' => '',
                'label'=>'Author Name',
                'id' => 'wooa_author_name',
                'placeholder' => 'Author Full Name',
                'value' => isset($values['wooa_author_name']) && $values['wooa_author_name'][0] != '' ? $values['wooa_author_name'][0] : ''
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textbox',
                'name'=>'wooa_author_profession',
                'class' => '',
                'label'=>'Author Profession',
                'id' => 'wooa_author_profession',
                'placeholder' => 'Example : Art Director',
                'value' => isset($values['wooa_author_profession']) && $values['wooa_author_profession'][0] != '' ? $values['wooa_author_profession'][0] : ''
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'select',
                'name'=>'wooa_author_country',
                'class' => '',
                'label'=>'Author Country',
                'id' => 'wooa_author_country',
                'value' => isset($values['wooa_author_country']) && $values['wooa_author_country'][0] != '' ? $values['wooa_author_country'][0] : '',
                'options' => wooa_core::return_all_country_names_for_admin_panel_input()
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textbox',
                'name'=>'wooa_author_city',
                'class' => '',
                'label'=>'Author City',
                'id' => 'wooa_author_city',
                'placeholder' => 'Example : Los Angeles',
                'value' => isset($values['wooa_author_city']) && $values['wooa_author_city'][0] != '' ? $values['wooa_author_city'][0] : ''
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'media',
                'name'=>'wooa_author_poster',
                'class' => '',
                'label'=>'Author Detail Poster',
                'id' => 'wooa_author_poster',
                'placeholder' => '',
                'value' => isset($values['wooa_author_poster']) && $values['wooa_author_poster'][0] != '' ? $values['wooa_author_poster'][0] : '',
                'value-url' => '',
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'email',
                'name'=>'wooa_author_email_address',
                'class' => '',
                'label'=>'Author Email Address',
                'id' => 'wooa_author_email_address',
                'placeholder' => 'Example@example.com',
                'value' => isset($values['wooa_author_email_address']) && $values['wooa_author_email_address'][0] != '' ? $values['wooa_author_email_address'][0] : ''
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'url',
                'name'=>'wooa_author_instagram_url',
                'class' => '',
                'label'=>'Author Instagram URL',
                'id' => 'wooa_author_instagram_url',
                'placeholder' => 'JohnDoe',
                'value' => isset($values['wooa_author_instagram_url']) && $values['wooa_author_instagram_url'][0] != '' ? $values['wooa_author_instagram_url'][0] : ''
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'url',
                'name'=>'wooa_author_dribble_url',
                'class' => '',
                'label'=>'Author Dribble URL',
                'id' => 'wooa_author_dribble_url',
                'placeholder' => 'JohnDoe',
                'value' => isset($values['wooa_author_dribble_url']) && $values['wooa_author_dribble_url'][0] != '' ? $values['wooa_author_dribble_url'][0] : ''
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'url',
                'name'=>'wooa_author_behance_url',
                'class' => '',
                'label'=>'Author Behance URL',
                'id' => 'wooa_author_behance_url',
                'placeholder' => 'JohnDoe',
                'value' => isset($values['wooa_author_behance_url']) && $values['wooa_author_behance_url'][0] != '' ? $values['wooa_author_behance_url'][0] : ''
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'url',
                'name'=>'wooa_author_twitter_url',
                'class' => '',
                'label'=>'Author Twitter URL',
                'id' => 'wooa_author_twitter_url',
                'placeholder' => 'JohnDoe',
                'value' => isset($values['wooa_author_twitter_url']) && $values['wooa_author_twitter_url'][0] != '' ? $values['wooa_author_twitter_url'][0] : ''
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'url',
                'name'=>'wooa_author_linkedin_url',
                'class' => '',
                'label'=>'Author Linkedin URL',
                'id' => 'wooa_author_linkedin_url',
                'placeholder' => 'JohnDoe',
                'value' => isset($values['wooa_author_linkedin_url']) && $values['wooa_author_linkedin_url'][0] != '' ? $values['wooa_author_linkedin_url'][0] : ''
            )
        );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textarea',
                'name'=>'wooa_author_description',
                'class' => '',
                'label'=>'Author Description',
                'id' => 'wooa_author_description',
                'placeholder' => '',
                'value' => isset($values['wooa_author_description']) && $values['wooa_author_description'][0] != '' ? $values['wooa_author_description'][0] : ''
            )
        );

    }



	/**
	 *
	 * Render 'product' post type meta box
	 *
	 * Here we first get current post meta data to pass them to our inputs , then we will create multiple inputs by
	 * using 'wooa_admin_input' class functions
	 *
	 * @return void
	 * @access public
	 *
	 */
    public function render_woocommerce_assign_author_metabox():void{

        $value = isset($_GET['post']) && $_GET['post'] != ''  ? get_post_meta( $_GET['post'] , 'wooa_product_author_id' , true  ) : '';


        wp_nonce_field( 'wooa_assign_author_metabox', 'wooa_assign_author_metabox' );

        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'select',
                'name'=>'wooa_product_author_id',
                'class' => '',
                'label'=>'Author Username',
                'id' => 'wooa_product_author_id',
                'value' => $value != '' ? $value : '',
                'options' => wooa_core::return_all_authors_for_admin_panel_input()
            )
        );

    }



	/**
	 *
	 * save 'woocommerce-author' post type meta box values
	 *
	 * First validate our nonce field and then loop through an array of the items which should be saved as meta data
	 * for current post , if the value is set we will update the post update , otherwise we will delete that specific
	 * post meta data
	 *
	 * @param $post_id int ID of the post we are currently saving
	 *
	 * @return void
	 * @access public
	 *
	 */
    public function save_woocommerce_author_info_metabox($post_id){

        if( !isset( $_POST['wooa_author_info_metabox'] ) || !wp_verify_nonce( $_POST['wooa_author_info_metabox'],'wooa_author_info_metabox') ){

            return;

        }

        if ( !current_user_can( 'edit_post', $post_id )){

            return;

        }

        $items_to_save = array(
            'wooa_author_username',
            'wooa_author_name',
            'wooa_author_profession',
            'wooa_author_country',
            'wooa_author_city',
            'wooa_author_email_address',
            'wooa_author_instagram_url',
            'wooa_author_dribble_url',
            'wooa_author_behance_url',
            'wooa_author_twitter_url',
            'wooa_author_linkedin_url',
            'wooa_author_description',
            'wooa_author_poster',
        );

        foreach ($items_to_save as $item){

            if( !is_null($_POST[$item] ) && $_POST[$item] != '' ){

                update_post_meta( $post_id , $item , $_POST[$item] );

            }else{

                delete_post_meta($post_id , $item );

            }

        }

    }



	/**
	 *
	 * save 'product' post type meta box values
	 *
	 * First validate our nonce field and then loop through an array of the items which should be saved as meta data
	 * for current post , if the value is set we will update the post update , otherwise we will delete that specific
	 * post meta data
	 *
	 * @param $post_id int ID of the post we are currently saving
	 *
	 * @return void
	 * @access public
	 *
	 */
    function save_woocommerce_assign_author_metabox($post_id){

        if( !isset( $_POST['wooa_assign_author_metabox'] ) || !wp_verify_nonce( $_POST['wooa_assign_author_metabox'],'wooa_assign_author_metabox') ){

            return;

        }

        if ( !current_user_can( 'edit_post', $post_id )){

            return;

        }


        $items_to_save = array('wooa_product_author_id');

        foreach ($items_to_save as $item){

            if( !is_null($_POST[$item] ) && $_POST[$item] != '' && $_POST[$item] != '0'){

                update_post_meta( $post_id , $item , $_POST[$item] );

            }else{

                delete_post_meta($post_id , $item );

            }

        }


    }




}


/**
 *
 * Check if we are in admin panel and then create a clone of 'wooa_meta_boxes' class
 *
 */

if ( is_admin() ) {

    add_action( 'load-post.php', function(){

        $wooa_meta_boxes = new wooa_meta_boxes();

    });


    add_action( 'load-post-new.php', function(){

        $wooa_meta_boxes = new wooa_meta_boxes();

    });


}
