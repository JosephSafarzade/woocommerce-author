<?php


/**
 * wooa_elementor class.
 *
 * @package wooa_elementor
 * @version 1.0
 */


class wooa_elementor{

    /**
     *  Class construction
     *
     *  Only call current class load_widgets function on elementor/widgets/register action to start registering elementor widget
     *
     *  @return void
     *
     */
    function __construct(){

        add_action('elementor/widgets/register' , array($this,'load_widgets') );

    }


    /**
     *
     *  Load widget function to register custom elementor widgets
     *
     *  This function has an array which contains name of widget files which should be loaded , then
     *  it will load each file separately from elementor-widget folder
     *
     * @return void
     */

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
            'class_elementor_widget_show_author_profile_picture.php',
            'class_elementor_widget_show_author_products.php'

        );

        foreach ($elementor_shortcodes as $widget){

            require_once(WOOA_PLUGIN_INC_DIR . DIRECTORY_SEPARATOR . "elementor-widgets" . DIRECTORY_SEPARATOR . $widget);

        }

    }

}

/**
 *
 *  Create a clone of wooa_elementor class if elementor plugin is activated
 *
 */
add_action('init',function(){

    if (is_plugin_active( 'elementor/elementor.php' )) {

        $wooa_elementor = new wooa_elementor();

    }

});