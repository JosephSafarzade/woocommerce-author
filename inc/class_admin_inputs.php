<?php

/**
 * wooa_admin_inputs class.
 *
 * This class is for output html content of inputs that we use in admin panel for settings
 *
 * @package wooa_admin_inputs
 * @version 1.0
 */
class wooa_admin_inputs
{


	/**
	 *
	 * render admin inputs
	 *
	 * Accept an array which contain an input config file then base on input type it will call specific function to
	 * continue rendering html content of the input
	 *
	 * @param array $input_config
	 *      $input_config = [
	 *          'type' => (string) type of input to be rendered ( 'check_elementor' , 'textbox' , 'textarea' , 'select' , 'media' , 'url' , 'email' ) ,
	 *          'name' => (string) name of input which will be used in name attribute of html input ,
	 *          'label' => (string) label which will be shown separately as a label tag for the input,
	 *          'class' => (string) classes to be added to class attribute of html input ( separate by space )
	 *          'id' => (string) ID of input which will be used for its label and input itself id attribute
	 *          'placeholder' => (string) show a placeholder when there is no value set ( if input support placeholder )
	 *          'value' => (string|array) a value which will be show in input
	 *      ]
	 *
	 *
	 * @access public
	 * @return void
	 */
    function render_admin_input(array $input_config):void{

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


	/**
	 *
	 * Render textbox html input
	 *
	 * Accept an array of input config and then base on that it will render an input type 'text'
	 *
	 *	@param array $input_config
	 *      $input_config = [
	 *          'name' => (string) name of input which will be used in name attribute of html input ,
	 *          'class' => (string) classes to be added to class attribute of html input ( separate by space ) ,
	 *          'label' => (string) label which will be shown separately as a label tag for the input,
	 *          'id' => (string) ID of input which will be used for its label and input itself id attribute
	 *          'placeholder' => (string) show a placeholder when there is no value set ( if input support placeholder )
	 *          'value' => (string) a value which will be show in input
	 *      ]
	 *
	 * @return void
	 *
	 */
    function render_textbox_input(array $input_config):void{

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



	/**
	 *
	 * Render email html input
	 *
	 * Accept an array of input config and then base on that it will render an input type 'email'
	 *
	 *	@param array $input_config
	 *      $input_config = [
	 *          'name' => (string) name of input which will be used in name attribute of html input ,
	 *          'class' => (string) classes to be added to class attribute of html input ( separate by space ) ,
	 *          'label' => (string) label which will be shown separately as a label tag for the input,
	 *          'id' => (string) ID of input which will be used for its label and input itself id attribute
	 *          'placeholder' => (string) show a placeholder when there is no value set ( if input support placeholder )
	 *          'value' => (string) a value which will be show in input
	 *      ]
	 *
	 * @return void
	 *
	 */
    function render_email_input(array $input_config):void{

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



	/**
	 *
	 * Render URL html input
	 *
	 * Accept an array of input config and then base on that it will render an input type 'url'
	 *
	 *	@param array $input_config
	 *      $input_config = [
	 *          'name' => (string) name of input which will be used in name attribute of html input ,
	 *          'class' => (string) classes to be added to class attribute of html input ( separate by space ) ,
	 *          'label' => (string) label which will be shown separately as a label tag for the input,
	 *          'id' => (string) ID of input which will be used for its label and input itself id attribute
	 *          'placeholder' => (string) show a placeholder when there is no value set ( if input support placeholder )
	 *          'value' => (string) a value which will be show in input
	 *      ]
	 *
	 * @return void
	 *
	 */
    function render_url_input(array $input_config):void{

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



	/**
	 *
	 * Render upload file html input
	 *
	 * It will create an input for showing the url of uploaded image , a hidden input which save the attachment ID of
	 * uploaded image , and the two button input to show upload panel and reset the input values
	 *
	 *	@param array $input_config
	 *      $input_config = [
	 *          'name' => (string) name of input which will be used in name attribute of html input ,
	 *          'class' => (string) classes to be added to class attribute of html input ( separate by space ) ,
	 *          'label' => (string) label which will be shown separately as a label tag for the input,
	 *          'id' => (string) ID of input which will be used for its label and input itself id attribute
	 *          'placeholder' => (string) show a placeholder when there is no value set ( if input support placeholder )
	 *          'value' => (string) Attachment ID of selected image
	 *          'value-url' => (string) URL of selected image
	 *      ]
	 *
	 * @return void
	 *
	 */
    function render_media_upload_input(array $input_config):void{

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




	/**
	 *
	 * Render select html input
	 *
	 * Accept an array of input config and then base on that it will render an input type 'select'
	 *
	 *	@param array $input_config
	 *      $input_config = [
	 *          'name' => (string) name of input which will be used in name attribute of html input ,
	 *          'class' => (string) classes to be added to class attribute of html input ( separate by space ) ,
	 *          'label' => (string) label which will be shown separately as a label tag for the input,
	 *          'id' => (string) ID of input which will be used for its label and input itself id attribute
	 *          'placeholder' => (string) show a placeholder when there is no value set ( if input support placeholder )
	 *          'value' => (array) array which the key of each item will be used as item value in select input and the
	 *                             value of each array item will be shown as a label in select input
	 *      ]
	 *
	 * @return void
	 *
	 */
    function render_select_input(array $input_config):void{


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



	/**
	 *
	 * Render textarea html input
	 *
	 * Accept an array of input config and then base on that it will render an input type 'textarea'
	 *
	 *	@param array $input_config
	 *      $input_config = [
	 *          'name' => (string) name of input which will be used in name attribute of html input ,
	 *          'class' => (string) classes to be added to class attribute of html input ( separate by space ) ,
	 *          'label' => (string) label which will be shown separately as a label tag for the input,
	 *          'id' => (string) ID of input which will be used for its label and input itself id attribute
	 *          'placeholder' => (string) show a placeholder when there is no value set ( if input support placeholder )
	 *          'value' => (string) a value which will be show in input
	 *      ]
	 *
	 * @return void
	 *
	 */
    function render_textarea_input(array $input_config):void{


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


	/**
	 *
	 * Render custom html section for checking elementor being active
	 *
	 * This input act as a html section which will check if elementor plugin is active and then if it configured to be
	 * available for woocommerce-author post type too , if it is not configured correctly we will show a notice which
	 * guide user what to do about it
	 *
	 *

	 * @return void
	 *
	 */
    function render_check_elementor_input():void{

        $supported_post_types  = get_option('elementor_cpt_support');

		$is_elementor_active = did_action( 'elementor/loaded' );

        $admin_url = get_admin_url( null , 'admin.php') . "?page=elementor";


		if($is_elementor_active == '1' && $supported_post_types == false){

			printf('<strong>Notice : Please visit <a href="%s">following page</a> to enable elementor for WooCommerce Author post type</strong>',$admin_url);

		} else {

			if(empty($supported_post_types) || $supported_post_types == ''){

				return;

			}else{

				if(!in_array('woocommerce-author',$supported_post_types)){

					printf('<strong>Notice : Please visit <a href="%s">following page</a> to enable elementor for WooCommerce Author post type</strong>',$admin_url);

				}

			}

		}

    }

}