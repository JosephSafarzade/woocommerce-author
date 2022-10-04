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
                'default' => '3',
                'options' => [
                    '2'     => esc_html__( 'Two', WOOA_TEXT_DOMAIN ),
                    '3'     => esc_html__( 'Three', WOOA_TEXT_DOMAIN ),
                    '4'     => esc_html__( 'Four', WOOA_TEXT_DOMAIN ),
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



        $this->end_controls_section();

        // Content Tab End


        // Style Tab Start


        // Style Tab End

    }


    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $settings['author_id'] =  apply_filters('wooa_return_author_id',$settings['author_id'] );

        $products = wooa_core::load_author_products($settings);

        if (!$products){

            _e('No products has been assigned to this author !' , 'WOOA_TEXT_DOMAIN');

        } else {

            wooa_core::generate_author_products_html($products);

        }



    }

}


$widgets_manager->register(new \wooa_elementor_widget_show_author_products());

