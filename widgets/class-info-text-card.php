<?php
/**
 * Information Text Card
 */


class Info_Text_Card_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'text_card';
    }

    public function get_title()
    {
        return __('Info Card', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-info-box';
    }

    public function get_keywords()
    {
        return [  'info', 'card'];
    }

    public function get_categories()
    {
        return ['custom-widgets'];
    }


    protected function _register_controls()
    {
        global $plugin_images; /*This php variable is from the main file, allows you to use images from the assets/ 
        images folder. */

        $this->start_controls_section(
            'text_info',
            [
                'label' => __('Info Text Card', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'info_title_text',
            [
                'label' => __('Title', 'elementor-addon'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Title', 'elementor-addon'),
                'default' => __('PLaceholder Title Here', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'info_desc',
            [
                'label' => __('Description', 'elementor-addon'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter your description here', 'elementor-addon'),
                'default' => __('Yes, I know “handcrafted” is a word only hipsters use, but you really will hand code your HTML & CSS.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'card_image',
            [
                'label' => __('Choose Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    /*'url' => \Elementor\Utils::get_placeholder_image_src(), //This is the Elementor function for  
                    getting a default placeholder image, if you want a custom placeholder then link one in as 
                    seen below. */
                    'url' => $plugin_images . '/card-css.png',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __('Background', 'elementor-addon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .text-card',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        global $plugin_images;
        $settings = $this->get_settings_for_display();

        echo '<div class="text-card style-1">';
        echo '<div class="overlay"></div>';
        echo '<h4>' . $settings['info_title_text'] . '</h4>';
        echo '<p>' . $settings['info_desc'] . '</p>';
        echo '<div class="overlay-image"><img src="' . esc_url($settings['card_image']['url']) . '"></div>';
        echo '</div>';
    }

}

// Register widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Info_Text_Card_Widget());