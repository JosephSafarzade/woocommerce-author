<?php

/**
 * wooa_elementor_widget_show_author_profile_picture class.
 *
 * a class to register custom elementor widget which extends Widget_Base class of Elementor namespace
 *
 * @package wooa_elementor_widget_show_author_profile_picture
 * @extends \Elementor\Widget_Base
 * @version 1.0
 *
 */
class wooa_elementor_widget_show_author_profile_picture extends \Elementor\Widget_Base
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
        return 'wooa_show_author_profile_picture';
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
        return esc_html__('Show Author Profile Picture', WOOA_TEXT_DOMAIN);
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
        return ['author', 'profile', 'picture', 'woocommerce'];
    }



    /**
     *
     * Register required setting for widget
     *
     * list of settings :
     *
     * author_id (string) id of author which we should fetch data from
     * author_profile_picture_dimension (array) an array which contains width and height value for loaded image
     * author_profile_picture_border_radius (int) border radius value for loaded image
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


        $this->add_control(
            'author_profile_picture_dimension',
            [
                'label' => esc_html__( 'Image Dimension', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'default' => [
                    'width' => '50',
                    'height' => '50',
                ],
            ]
        );


        $this->add_control(
            'author_profile_picture_border_radius',
            [
                'label' => esc_html__( 'Border Radius', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wooa-author-profile-picture' => 'border-radius: {{SIZE}}{{UNIT}};',
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
     * we will call wooa_show_author_profile_picture shortcode with required parameters
     *
     *
     * @return void
     *
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $shortcode = sprintf(

            '[wooa_show_author_profile_picture author_id="%s" width="%s" height="%s"][/wooa_show_author_profile_picture]',

            apply_filters('wooa_return_author_id',$settings['author_id'] ) ,

            $settings['author_profile_picture_dimension']['width'] ,

            $settings['author_profile_picture_dimension']['height'] ,

        );

        echo do_shortcode( $shortcode );


    }

}

/* Register widget by elementor */
$widgets_manager->register(new \wooa_elementor_widget_show_author_profile_picture());
