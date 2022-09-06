<?php


class wooa_admin_inputs
{

    function __construct(){}


    function render_admin_input(array $input_config){



        switch ($input_config['type']) {


            case 'textbox' :
                $this->render_textbox_input($input_config);
            break;

            case 'textarea' :
                $this->render_textarea_input($input_config);
            break;

            case 'select' :
                $this->render_select_input($input_config);
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

}