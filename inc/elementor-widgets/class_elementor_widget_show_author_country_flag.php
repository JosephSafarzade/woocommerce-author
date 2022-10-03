<?php


class wooa_elementor_widget_show_author_country_flag extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'wooa_show_author_country_flag';
    }

    public function get_title()
    {
        return esc_html__('Show Author Country Flag', WOOA_TEXT_DOMAIN);
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
        return ['author', 'flag' , 'country', 'woocommerce'];
    }


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
            'country_flag_dimension',
            [
                'label' => esc_html__( 'Image Dimension', WOOA_TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'description' => esc_html__( 'Set width and height for selected image', WOOA_TEXT_DOMAIN ),
                'default' => [
                    'width' => '50',
                    'height' => '50',
                ],
            ]
        );



        $this->end_controls_section();

        // Content Tab End



    }


    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $author_id = apply_filters('wooa_return_author_id',$settings['author_id'] );

        $country_code =  get_post_meta($author_id , 'wooa_author_country' , true );

        $country_flag = 'https://countryflagsapi.com/png/' . $country_code ;

        if($settings['country_flag_dimension']['width'] != '' && $settings['country_flag_dimension']['height'] != ''){

            printf (
                "<img class='wooa-author-country-flag-image' width='%spx' height='%spx' src='%s' >",
                esc_attr($settings['country_flag_dimension']['width']) ,
                esc_attr($settings['country_flag_dimension']['height']) ,
                $country_flag
            );

        } else{

            printf (
                "<img class='wooa-author-country-flag-image' src='%s' >"
                , $country_flag
            );

        }



    }

}


$widgets_manager->register(new \wooa_elementor_widget_show_author_country_flag());