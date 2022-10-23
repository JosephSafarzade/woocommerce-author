<?php


class wooa_elementor_widget_show_author_products extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'wooa_show_author_products';
    }

    public function get_title()
    {
        return esc_html__('Show Author Products', WOOA_TEXT_DOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['author', 'products', 'woocommerce'];
    }

    public function get_style_depends() {

        if( !wp_style_is( 'frontend-general', 'registered' ) ){

            wp_register_style( 'frontend-general',WOOA_ASSETS_CSS_FOLDER_URL . "/frontend-general.css" , [] ,WOOA_PLUGIN_VERSION);

        }

        return [ 'frontend-general' ];
    }


    protected function register_controls()
    {

        // Content Tab Start

        $this->start_controls_section(
            'author_setting',
            [
                'label' => esc_html__('Author Setting', 'elementor-addon'),
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
            'products_columns',
            [
                'label' => esc_html__( 'Number of Columns', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    2    => esc_html__( 'Two', WOOA_TEXT_DOMAIN ),
                    3     => esc_html__( 'Three', WOOA_TEXT_DOMAIN ),
                    4     => esc_html__( 'Four', WOOA_TEXT_DOMAIN ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .wooa-author-products-container' => 'grid-template-columns: repeat({{VALUE}}, 1fr) ;',
                ],
            ]
        );


        $this->add_control(
            'products_count',
            [
                'label' => esc_html__( 'Number of Products', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => -1,
                'max' => 999,
                'default' => 10,
                'description' => esc_html__( 'Set -1 to show all products assigned to author', WOOA_TEXT_DOMAIN ),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'Select Title Tag', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => wooa_core::return_container_tag_list_for_elementor_widget_setting(),
                'default' => [ 'h5' ],
            ]
        );


        $this->add_control(
            'product-button-color',
            [
                'label' => esc_html__( 'Product Button Color', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'description' => esc_html__( ' Color for ADD TO CART Button Text ', 'elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wooa-product-item-style-1__add-to-cart a' => 'color: {{VALUE}} ;',
                ],

            ],

        );

        $this->add_control(
            'product-button-background',
            [
                'label' => esc_html__( 'Product Button Background Color', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'description' => esc_html__( 'Background Color for ADD TO CART Button ', 'elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wooa-product-item-style-1__add-to-cart a' => 'background-color: {{VALUE}} ;',
                ],

            ],

        );


        $this->end_controls_section();

        // Content Tab End


        // Style Tab Start


        // Style Tab End

    }


    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $shortcode = sprintf(

            '[wooa_show_author_products author_id="%s"  products_columns="%s" products_count="%s" title_tag="%s" /]',

            apply_filters('wooa_return_author_id',$settings['author_id'] ) ,

            $settings['products_columns'] ,

            $settings['products_count'] ,

            $settings['title_tag'][0]

        );

        echo do_shortcode( $shortcode );

    }

}


$widgets_manager->register(new \wooa_elementor_widget_show_author_products());

