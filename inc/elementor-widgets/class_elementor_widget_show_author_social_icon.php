<?php

/**
 * wooa_elementor_widget_show_author_social_icon class.
 *
 * a class to register custom elementor widget which extends Widget_Base class of Elementor namespace
 *
 * @package wooa_elementor_widget_show_author_social_icon
 * @extends \Elementor\Widget_Base
 * @version 1.0
 *
 */
class wooa_elementor_widget_show_author_social_icon extends \Elementor\Widget_Base
{

    /**
     *
     * Return widget name which will be used by elementor itself
     *
     * @return string name of widget
     *
     */
    public function get_name()
    {
        return 'wooa_show_author_social_icon';
    }


    /**
     *
     * Return widget name which will appear in elementor builder
     *
     * @return string title of widget
     *
     */
    public function get_title()
    {
        return esc_html__('Show Author Social Icon', WOOA_TEXT_DOMAIN);
    }


    /**
     *
     * Return widget icon name which will appear in elementor builder
     *
     * @return string icon of widget
     *
     */
    public function get_icon()
    {
        return 'eicon-code';
    }


    /**
     *
     * Return widget categories which will be used in elementor builder search and grid of widget names
     *
     * @return array array which contains category name assigned to this widget
     *
     */
    public function get_categories()
    {
        return ['basic'];
    }


    /**
     *
     * Return widget keywords which will be used in elementor builder search and grid of widget names
     *
     * @return array array which contains keywords name assigned to this widget
     *
     */
    public function get_keywords()
    {
        return ['author', 'social', 'icon', 'woocommerce'];
    }


    /**
     *
     * Register required style resources for this widget and then return their name so they will be loaded when user
     * insert the widget into content
     *
     * @return array array which contains name of registered styles name
     *
     */
    public function get_style_depends() {

        if( !wp_style_is( 'frontend-general', 'registered' ) ){

            wp_register_style( 'frontend-general',WOOA_ASSETS_CSS_FOLDER_URL . "/frontend-general.css" , [] ,WOOA_PLUGIN_VERSION);

        }

        return [ 'frontend-general' ];
    }



    /**
     *
     * Register required setting for widget
     *
     * list of settings :
     *
     * author_id (string) id of author which we should fetch data from
     * social_name (array) a repeater elementor controller which contains name of social item and its icon name
     * icon_size (int) font size of loaded icons in pixels
     * icon_distance (int) distance between each loaded icon in pixel ( used with padding right of each icon )
     * icon_color (string) color of loaded icon
     * icon_hvoer_color (string) hover color of loaded icons
     *
     *
     *
     * @return void
     *
     */
    protected function register_controls()
    {

        // Content Tab Start

        $this->start_controls_section(
            'author_setting',
            [
                'label' => esc_html__('Author Setting', WOOA_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'author_id',
            [
                'label' => esc_html__('Select Author', WOOA_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => wooa_core::return_author_list_for_elementor_widget_setting(),
                'default' => ['0'],
                'description' => esc_html__('If you select default then we check for current author ( single author page ) or assigned author to current product ( product detail )', WOOA_TEXT_DOMAIN),
            ]
        );




        $repeater = new \Elementor\Repeater();




        $repeater->add_control(
            'social_name',
            [
                'label' => esc_html__('Select Social Media', WOOA_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => wooa_core::return_social_list_for_elementor_widget_setting(),
                'default' => ['0'],
                'description' => esc_html__('If you select default then we check for current author ( single author page ) or assigned author to current product ( product detail )', WOOA_TEXT_DOMAIN),
            ]
        );


        $repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__( 'Social Icon', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'recommended' => [],
            ]
        );



        $this->add_control(
            'social_list',
            [
                'label' => esc_html__( 'Social Icons', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );




        $this->end_controls_section();



	    $this->start_controls_section(
		    'author-social-icons-style-settings',
		    [
			    'label' => esc_html__('Icons Styles', WOOA_TEXT_DOMAIN),
			    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
	    );


	    $this->add_control(
		    'icon_size',
		    [
			    'label' => esc_html__( 'Icon Size', WOOA_TEXT_DOMAIN ),
			    'type' => \Elementor\Controls_Manager::NUMBER,
			    'min' => 20,
			    'max' => 999,
			    'default' => 20,
			    'selectors' => [
				    '{{WRAPPER}} .wooa-social-icon-container i' => 'font-size: {{VALUE}}px',
			    ],
		    ]
	    );



	    $this->add_control(
		    'icon_distance',
		    [
			    'label' => esc_html__( 'Icon Distance', WOOA_TEXT_DOMAIN ),
			    'type' => \Elementor\Controls_Manager::NUMBER,
			    'min' => 10,
			    'max' => 100,
			    'default' => 10,
			    'selectors' => [
				    '{{WRAPPER}} .wooa-social-icon-link' => 'padding-right: {{VALUE}}px',
			    ],
		    ]
	    );


	    $this->add_control(
		    'icon_color',
		    [
			    'label' => esc_html__('Icon Color', WOOA_TEXT_DOMAIN),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .wooa-social-icon-container i' => 'color: {{VALUE}}',
			    ],
		    ]
	    );



	    $this->add_control(
		    'icon_hover_color',
		    [
			    'label' => esc_html__('Icon Hover Color', WOOA_TEXT_DOMAIN),
			    'type' => \Elementor\Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .wooa-social-icon-link:hover i' => 'color: {{VALUE}}',
			    ],
		    ]
	    );


	    $this->end_controls_section();


	    // Content Tab End


    }



    /**
     *
     * Render widget output for users
     *
     * in this function first we will fetch saved setting for widget by using get_settings_for_display function then
     * we loop through $social_list item of loaded setting ( it contains an array of social name and icon name ) , in
     * each iteration we will add icon and social name to $social_icons array which we will use later , after that we will
     * loop through social_icons and for each item we will add $social_icon_%s_icon and social_icon_%s_name ( %s is a counter
     * which will increase by one in each iteration ) to $social_string ( this string will be added to a string which we will use in
     * do_shortcode function as a shortcode parameters ) at end we call do_shortcode function for wooa_show_author_social_icons shortcode with
     * generated parameters from before sections
     *
     *
     * @return void
     *
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $social_icons = array();

        $social_string = '';

        if($settings['social_list']){

            foreach ($settings['social_list'] as $item){


                $social_name = $item['social_name'];

                if($social_name[0] == '0' || $social_name == '0' || $social_name == '') {

                    continue;

                } else {


                    $social_icons[] = array( 'icon'=> $item['social_icon']['value'] , 'name' => $social_name ) ;

                }

            }


        }

        $counter = 1;

        foreach ($social_icons as $social_item){

            $social_string .= sprintf(
                " social_icon_%s_icon='%s' social_icon_%s_name='%s' ",
                $counter,
                $social_item['icon'],
                $counter,
                $social_item['name']

            );

            $counter++;

        }


       $shortcode = sprintf(

            "[wooa_show_author_social_icons author_id='%s'  %s /]",

            apply_filters('wooa_return_author_id',$settings['author_id'] ) ,

            $social_string ,

        );


        echo do_shortcode( $shortcode );


    }

}

/* Register widget by elementor */
$widgets_manager->register(new \wooa_elementor_widget_show_author_social_icon());
