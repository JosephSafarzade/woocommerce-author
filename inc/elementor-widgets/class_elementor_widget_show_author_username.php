<?php

/**
 * wooa_elementor_widget_show_author_username class.
 *
 * a class to register custom elementor widget which extends Widget_Base class of Elementor namespace
 *
 * @package wooa_elementor_widget_show_author_username
 * @extends \Elementor\Widget_Base
 * @version 1.0
 *
 */
class wooa_elementor_widget_show_author_username extends \Elementor\Widget_Base
{

    /**
     *
     * Return widget name which will be used by elementor itself
     *
     * @return string name of widget
     *
     */
    public function get_name() {
        return 'wooa_show_author_username';
    }


    /**
     *
     * Return widget name which will appear in elementor builder
     *
     * @return string title of widget
     *
     */
    public function get_title() {
        return esc_html__( 'Show Author Username', WOOA_TEXT_DOMAIN );
    }


    /**
     *
     * Return widget icon name which will appear in elementor builder
     *
     * @return string icon of widget
     *
     */
    public function get_icon() {
        return 'eicon-code';
    }


    /**
     *
     * Return widget categories which will be used in elementor builder search and grid of widget names
     *
     * @return array array which contains category name assigned to this widget
     *
     */
    public function get_categories() {
        return [ 'basic' ];
    }


    /**
     *
     * Return widget keywords which will be used in elementor builder search and grid of widget names
     *
     * @return array array which contains keywords name assigned to this widget
     *
     */
    public function get_keywords() {
        return [ 'author', 'name' , 'woocommerce' ];
    }


    /**
     *
     * Register required setting for widget
     *
     * list of settings :
     *
     * author_id (string) id of author which we should fetch data from
     * container_tag (string) a html tag which we should wrap data in it
     * container_color (string) color of text which is showing fetched data
     *
     *
     *
     * @return void
     *
     */
    protected function register_controls() {

        // Content Tab Start

        $this->start_controls_section(
            'author_setting',
            [
                'label' => esc_html__( 'Author Setting', 'elementor-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'author_id',
            [
                'label' => esc_html__( 'Select Author', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => wooa_core::return_author_list_for_elementor_widget_setting(),
                'default' => [ '0' ],
                'description' => esc_html__( 'If you select default then we check for current author ( single author page ) or assigned author to current product ( product detail )', WOOA_TEXT_DOMAIN ),
            ]
        );

        $this->end_controls_section();

        // Content Tab End


        // Style Tab Start

        $this->start_controls_section(
            'appearance_setting',
            [
                'label' => esc_html__( 'Appearance Setting', WOOA_TEXT_DOMAIN ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'container_tag',
            [
                'label' => esc_html__( 'Select Container Tag', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => wooa_core::return_container_tag_list_for_elementor_widget_setting(),
                'default' => 'p',
            ]
        );

        $this->add_control(
            'container_color',
            [
                'label' => esc_html__( 'Text Color', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wooa-author-username-container' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab End

    }



    /**
     *
     * Render widget output for users
     *
     * in this function first we will fetch saved setting for widget by using get_settings_for_display function then
     * we will call wooa_show_author_username shortcode with required parameters
     *
     *
     * @return void
     *
     */
    protected function render() {


        $settings = $this->get_settings_for_display();

        $shortcode = sprintf(

            '[wooa_show_author_username author_id="%s" container_tag="%s" /]',

            apply_filters('wooa_return_author_id',$settings['author_id'] ) ,

            $settings['container_tag'] ,

        );

        echo do_shortcode( $shortcode );


    }

}



$widgets_manager->register( new \wooa_elementor_widget_show_author_username() );
