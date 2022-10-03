<?php


class wooa_admin_inputs
{

    function __construct(){}


    function render_admin_input(array $input_config){



        switch ($input_config['type']) {

            case  'check_elementor':
                $this->render_check_elementor_input();
            break;

            case 'textbox' :
                $this->render_textbox_input($input_config);
            break;

            case 'textarea' :
                $this->render_textarea_input($input_config);
            break;

            case 'select' :
                $this->render_select_input($input_config);
            break;

            case 'media' :
                $this->render_media_upload_input($input_config);
            break;

            case 'url' :
                $this->render_url_input($input_config);
            break;

            case 'email' :
                $this->render_email_input($input_config);
            break;


        }


    }




    function render_textbox_input(array $input_config){

        printf(
            "<div class='wooa-admin-input-container'>
                        <label class='wooa-admin-input-label' for='%s' >%s :</label>
                        <input  class='wooa-admin-input wooa-admin-input-text %s' type='text' name='%s' id='%s' value='%s' placeholder='%s'>
                   </div>"
            ,
            $input_config['id'],
            $input_config['label'],
            $input_config['class'],
            $input_config['name'],
            $input_config['id'],
            $input_config['value'],
            $input_config['placeholder']
        );

    }



    function render_email_input(array $input_config){

        printf(
            "<div class='wooa-admin-input-container'>
                        <label class='wooa-admin-input-label' for='%s' >%s :</label>
                        <input  class='wooa-admin-input wooa-admin-input-email %s' type='email' name='%s' id='%s' value='%s' placeholder='%s'>
                   </div>"
            ,
            $input_config['id'],
            $input_config['label'],
            $input_config['class'],
            $input_config['name'],
            $input_config['id'],
            $input_config['value'],
            $input_config['placeholder']
        );

    }



    function render_url_input(array $input_config){




        printf(
            "<div class='wooa-admin-input-container'>
                        <label class='wooa-admin-input-label' for='%s' >%s :</label>
                        <input  class='wooa-admin-input wooa-admin-input-url %s' type='url' name='%s' id='%s' value='%s' placeholder='%s'>
                   </div>"
            ,
            $input_config['id'],
            $input_config['label'],
            $input_config['class'],
            $input_config['name'],
            $input_config['id'],
            $input_config['value'],
            $input_config['placeholder']
        );


    }




    function render_media_upload_input(array $input_config){

        $input_config['value-url'] = $input_config['value'] != '' ? wp_get_attachment_url($input_config['value']) : '' ;

        printf("<div class='wooa-admin-input-container'>
                            <label class='wooa-admin-input-label' for='%s' >%s :</label>
                            <input class='wooa-admin-input wooa-admin-input-text wooa-admin-input-url-value' type='text' name='%s' id='%s' value='%s'>
                            <input class='wooa-admin-input-id-value' type='hidden' name='%s' id='%s' value='%s'>
                            <div class='wooa-input-type-button-container'>
                                <input class='wooa-admin-input wooa-input-type-button wooa-media-upload-button' type='button' value='Choose an Image'>
                                <input class='wooa-admin-input wooa-input-type-button wooa-media-reset-button' type='button' value='Remove'>
                            </div>                          
                       </div>"
        ,
            $input_config['id'].'-url',
            $input_config['label'],
            $input_config['name']."-url",
            $input_config['id'].'-url',
            $input_config['value-url'],
            $input_config['name'],
            $input_config['id'],
            $input_config['value'],
        );

    }




    function render_select_input(array $input_config){


        printf('<div class="wooa-admin-input-container">');

            printf('<label class="wooa-admin-input-label" for="%s">%s  :</label> <br />',$input_config['id'] , $input_config['label']);

            printf('<select class="wooa-admin-input wooa-admin-input-select" name="%s" id="%s">' , $input_config['name'] , $input_config['id'] );

            foreach ($input_config['options'] as $item_value  => $item_label ){

                $selected = $item_value == $input_config['value'] ? 'selected' : '';

                printf('<option value="%s" %s>%s</option>' , $item_value , $selected , $item_label );

            }

            printf('</select>');

        printf('</div>');

    }




    function render_textarea_input(array $input_config){


        printf(
            "<div class='wooa-admin-input-container'>
                        <label class='wooa-admin-input-label' for='%s' >%s :</label>
                        <textarea class='wooa-admin-input wooa-admin-input-textarea %s' name='%s' id='%s' >%s</textarea>
                   </div>"
            ,
            $input_config['id'],
            $input_config['label'],
            $input_config['class'],
            $input_config['name'],
            $input_config['id'],
            $input_config['value'],
        );


    }


    function render_check_elementor_input(){

        $supported_post_types  = get_option('elementor_cpt_support');

        $admin_url = get_admin_url( null , 'admin.php') . "?page=elementor";

        if(empty($supported_post_types) || $supported_post_types == ''){

            return;

        }else{

            if(!in_array('woocommerce-author',$supported_post_types)){

                printf('<strong>Notice : Please visit <a href="%s">following page</a> to enable elementor for WooCommerce Author post type</strong>',$admin_url);

            }

        }



    }

}