<?php


class wooa_elementor_widget_show_author_social_icon extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'wooa_show_author_social_icon';
    }

    public function get_title()
    {
        return esc_html__('Show Author Social Icon', WOOA_TEXT_DOMAIN);
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
        return ['author', 'social', 'icon', 'woocommerce'];
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


$widgets_manager->register(new \wooa_elementor_widget_show_author_social_icon());
