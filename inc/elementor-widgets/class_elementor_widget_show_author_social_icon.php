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


        $this->add_control(
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



        $this->end_controls_section();

        // Content Tab End


    }


    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $author_id = apply_filters('wooa_return_author_id', $settings['author_id']);

        $social_name = $settings['social_name'];

        if($social_name == '0' || $social_name == '') {

            printf("<p>No Social Name Has Been Selected !</p>");

            return false;

        }

        $social_url = get_post_meta($author_id,"wooa_author_{$social_name}_url",true);


        ?>

        <a href="<?php echo esc_url($social_url) ?>" target="_blank" rel="nofollow">

            <span class="wooa-social-icon-container">

                <?php \Elementor\Icons_Manager::render_icon( $settings['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>

            </span>

        </a>


        <?php


    }

}


$widgets_manager->register(new \wooa_elementor_widget_show_author_social_icon());
