<?php


class wooa_meta_boxes
{

    private $wooa_admin_inputs;

    public function __construct(){

        add_action( 'add_meta_boxes', array( $this, 'create_woocommerce_author_info_metabox' ) );

        add_action( 'save_post',  array( $this, 'save_woocommerce_author_info_metabox' ) );

        add_action( 'save_post',  array( $this, 'save_woocommerce_assign_author_metabox' ) );



        $this->wooa_admin_inputs = new wooa_admin_inputs();

    }



    function create_woocommerce_author_info_metabox($post_type){

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



    function render_woocommerce_author_info_metabox(){

        $values = $_GET['post'] != ''  ? get_post_meta( $_GET['post']  ) : [];


        wp_nonce_field( 'wooa_author_info_metabox', 'wooa_author_info_metabox' );



        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textbox',
                'name'=>'wooa_author_username',
                'class' => '',
                'label'=>'Author Username',
                'id' => 'wooa_author_username',
                'placeholder' => 'Author Username',
                'value' => $values['wooa_author_username'][0] != '' ? $values['wooa_author_username'][0] : ''
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
                'value' => $values['wooa_author_name'][0] != '' ? $values['wooa_author_name'][0] : ''
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
                'value' => $values['wooa_author_profession'][0] != '' ? $values['wooa_author_profession'][0] : ''
            )
        );


        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'select',
                'name'=>'wooa_author_country',
                'class' => '',
                'label'=>'Author Country',
                'id' => 'wooa_author_country',
                'value' => $values['wooa_author_country'][0] != '' ? $values['wooa_author_country'][0] : '',
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
                'value' => $values['wooa_author_city'][0] != '' ? $values['wooa_author_city'][0] : ''
            )
        );


        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textbox',
                'name'=>'wooa_author_email_address',
                'class' => '',
                'label'=>'Author Email Address',
                'id' => 'wooa_author_email_address',
                'placeholder' => 'Example@example.com',
                'value' => $values['wooa_author_email_address'][0] != '' ? $values['wooa_author_email_address'][0] : ''
            )
        );



        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textbox',
                'name'=>'wooa_author_instagram_username',
                'class' => '',
                'label'=>'Author Instagram Username',
                'id' => 'wooa_author_instagram_username',
                'placeholder' => 'JohnDoe',
                'value' => $values['wooa_author_instagram_username'][0] != '' ? $values['wooa_author_instagram_username'][0] : ''
            )
        );


        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textbox',
                'name'=>'wooa_author_dribble_username',
                'class' => '',
                'label'=>'Author Dribble Username',
                'id' => 'wooa_author_dribble_username',
                'placeholder' => 'JohnDoe',
                'value' => $values['wooa_author_dribble_username'][0] != '' ? $values['wooa_author_dribble_username'][0] : ''
            )
        );


        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textbox',
                'name'=>'wooa_author_behance_username',
                'class' => '',
                'label'=>'Author Behance Username',
                'id' => 'wooa_author_behance_username',
                'placeholder' => 'JohnDoe',
                'value' => $values['wooa_author_behance_username'][0] != '' ? $values['wooa_author_behance_username'][0] : ''
            )
        );



        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textbox',
                'name'=>'wooa_author_twitter_username',
                'class' => '',
                'label'=>'Author Twitter Username',
                'id' => 'wooa_author_twitter_username',
                'placeholder' => 'JohnDoe',
                'value' => $values['wooa_author_twitter_username'][0] != '' ? $values['wooa_author_twitter_username'][0] : ''
            )
        );



        $this->wooa_admin_inputs->render_admin_input(
            array(
                'type'=>'textbox',
                'name'=>'wooa_author_linkedin_username',
                'class' => '',
                'label'=>'Author Linkedin Username',
                'id' => 'wooa_author_linkedin_username',
                'placeholder' => 'JohnDoe',
                'value' => $values['wooa_author_linkedin_username'][0] != '' ? $values['wooa_author_linkedin_username'][0] : ''
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
                'value' => $values['wooa_author_description'][0] != '' ? $values['wooa_author_description'][0] : ''
            )
        );



    }




    public function render_woocommerce_assign_author_metabox(){

        $value = $_GET['post'] != ''  ? get_post_meta( $_GET['post'] , 'wooa_product_author_id' , true  ) : [];


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
            'wooa_author_instagram_username',
            'wooa_author_dribble_username',
            'wooa_author_behance_username',
            'wooa_author_twitter_username',
            'wooa_author_linkedin_username',
            'wooa_author_description'
        );




        foreach ($items_to_save as $item){

            if( !is_null($_POST[$item] ) && $_POST[$item] != '' ){

                update_post_meta( $post_id , $item , $_POST[$item] );

            }else{

                delete_post_meta($post_id , $item );

            }

        }




    }



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



if ( is_admin() ) {

    add_action( 'load-post.php', function(){

        $wooa_meta_boxes = new wooa_meta_boxes();

    });


    add_action( 'load-post-new.php', function(){

        $wooa_meta_boxes = new wooa_meta_boxes();

    });


}
