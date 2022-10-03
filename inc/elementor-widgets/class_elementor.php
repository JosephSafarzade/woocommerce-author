<?php

class wooa_elementor{

    function __construct(){

        add_action('elementor/widgets/register' , array($this,'load_widgets') );

    }

    public function load_widgets($widgets_manager){


        $elementor_shortcodes = array(
            'class_elementor_widget_show_author_name.php',
            'class_elementor_widget_show_author_username.php',
            'class_elementor_widget_show_author_profession.php',
            'class_elementor_widget_show_author_email.php',
            'class_elementor_widget_show_author_description.php',
            'class_elementor_widget_show_author_city.php',
            'class_elementor_widget_show_author_country.php',
            'class_elementor_widget_show_author_country_flag.php',
            'class_elementor_widget_show_author_social_icon.php',
            'class_elementor_widget_show_author_profile_picture.php'
        );

        foreach ($elementor_shortcodes as $widget){

            require_once(WOOA_PLUGIN_INC_DIR . DIRECTORY_SEPARATOR . "elementor-widgets" . DIRECTORY_SEPARATOR . $widget);

        }

    }

}


add_action('init',function(){

    if (is_plugin_active( 'elementor/elementor.php' )) {

        $wooa_elementor = new wooa_elementor();

    }

});