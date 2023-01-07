<?php
/**
 * Custom Elementor Widget with Subtitle and Title
 */

class Class_Title_Widget extends \Elementor\Widget_Base {

  public function get_name() {
    return 'class_title';
  }

	public function get_title() {
    return __( 'Title with Subtitle', 'elementor-addon' );
  }

	public function get_icon() {
    return 'eicon-site-title';
  }

  public function get_keywords() {
    return [ 'title', 'subtitle', 'heading'];
  }

	public function get_categories() {
    return ['custom-widgets'];
  }

	protected function _register_controls() {

    $this->start_controls_section(

      'class_title',
      [
        'label' => __( 'Title with Subtitle', 'elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]

    );

    $this->add_control(
      'sub_title_text',
      [
        'label' => __('Sub Title Text', 'elementor-addon'),
        'label_block' => true,
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Type Your Sub Title Here', 'elementor-addon' ),
        'default' => __( 'Subtitle text goes here', 'elementor-addon' ),
      ]
    );

    $this->add_control( //Lets you select colours
      'sub_title_color',
      [
        'label' => __( 'Sub Title Color', 'elementor-addon' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#F50057',
        'selectors' => [
					'{{WRAPPER}} .sub-title' => 'color: {{VALUE}}',
				],
      ]
    );

    $this->add_control(
      'title_text',
      [
        'label' => __('Title Text', 'elementor-addon'),
        'label_block' => true,
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Add your title here', 'elementor-addon' ),
        'default' => __( 'Title text goes here', 'elementor-addon' ),
      ]
    );

    $this->add_control(
      'title_color',
      [
        'label' => __( 'Title Color', 'elementor-addon' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#111111',
        'selectors' => [
					'{{WRAPPER}} h2' => 'color: {{VALUE}}',
				],
      ]
    );

    $this->add_control(
      'title_align',
      [
        'label' => __( 'Alignment', 'elementor-addon' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [

          'text-start' => [
            'title' => __( 'Left', 'elementor-addon' ),
						'icon' => 'eicon-text-align-left',
          ],

          'text-center' => [
            'title' => __( 'Center', 'elementor-addon' ),
						'icon' => 'eicon-text-align-center',
          ],

          'text-end' => [
            'title' => __( 'Right', 'elementor-addon' ),
						'icon' => 'eicon-text-align-right',
          ],

        ],

        'default' => 'text-start',
        'toggle' => true,
      ]
    );


    $this->end_controls_section();

  }

  	protected function render() {
      $settings = $this->get_settings_for_display();

      echo '<div class="title-wrapper ' . $settings['title_align'] . '">';
      echo '<p class="sub-title">' . $settings['sub_title_text'] . '</p>';
      echo '<h2>' . $settings['title_text'] . '</h2>';
      echo '</div>';
    }


}

// Register widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Class_Title_Widget() );
