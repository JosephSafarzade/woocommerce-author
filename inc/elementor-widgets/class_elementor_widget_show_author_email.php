<?php


class wooa_elementor_widget_show_author_email extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'wooa_show_author_profession';
    }

    public function get_title()
    {
        return esc_html__('Show Author Profession', WOOA_TEXT_DOMAIN);
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
        return ['author', 'name', 'woocommerce'];
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

        $this->end_controls_section();

        // Content Tab End


        // Style Tab Start

        $this->start_controls_section(
            'appearance_setting',
            [
                'label' => esc_html__('Appearance Setting', WOOA_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'container_tag',
            [
                'label' => esc_html__('Select Container Tag', WOOA_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => wooa_core::return_container_tag_list_for_elementor_widget_setting(),
                'default' => ['p'],
            ]
        );


        $this->add_control(
            'is_it_linkable',
            [
                'label' => esc_html__('Link ( Open Email app on Click )', WOOA_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', WOOA_TEXT_DOMAIN),
                'label_off' => esc_html__( 'No', WOOA_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'container_color',
            [
                'label' => esc_html__('Text Color', WOOA_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wooa-author-email-container' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab End

    }


    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $container = $settings['container_tag'];

        $author_id = apply_filters('wooa_return_author_id', $settings['author_id']);

        $author_email = apply_filters('wooa_show_author_email', $author_id);

        if($settings['is_it_linkable'] === 'yes'){

            printf(
                "<a class='wooa-author-email-container' href='%s'>%s</a>",
                'mailto:' . sanitize_email($author_email),
                sanitize_email($author_email),
            );


        }else{

            printf(
                "<%s class='wooa-author-email-container'>%s</%s>",
                $container,
                sanitize_email($author_email),
                $container
            );

        }


    }

}


$widgets_manager->register(new \wooa_elementor_widget_show_author_email());
