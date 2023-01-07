<?php
/**
 * Custom Widget Link
 */

class Color_Link_Widget extends \Elementor\Widget_Base {

  public function get_name() {
		return 'color_link';
	}

  public function get_title() {
		return __( 'Colored Link', 'elementor-addon' );
	}

  public function get_icon() {
		return 'eicon-editor-link';
	}

  public function get_keywords() {
		return [  'button', 'link' ];
	}

  public function get_categories() {
		return [ 'custom-widgets' ];
	}

  protected function _register_controls() {
    $this->start_controls_section(
      'color_link',
      [
				'label' => __( 'Colored Link', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
    );

    $this->add_control(
      'link_text',
      [
        'label' => __('Link Text', 'elementor-addon'),
				'label_block' => true,
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Enter Link Text', 'elementor-addon' ),
        'default' => __( 'Click here ->', 'elementor-addon' ),
      ]
    );

    $this->add_control(
      'link_url',
      [
        'label' => __( 'Link URL', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::URL,
        'show_external' => true,
        'default' => [
          'url' => '#',
          'is_external' => true,
					'nofollow' => false,
        ],
      ]
    );

    $this->add_control(
			'link_color',
			[
        'label' => __( 'Link Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ff3366',
        'selectors' => [
					'{{WRAPPER}} .colored-link' => 'color: {{VALUE}}',
				],
      ]
    );

    $this->add_control(
			'link_color_hover',
			[
        'label' => __( 'Hover Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#333333',
        'selectors' => [
					'{{WRAPPER}} .colored-link:hover' => 'color: {{VALUE}}', //This is css
				],
      ]
    );

    $this->add_control(
			'link_align',
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
    $target = $settings['link_url']['is_external'] ? ' target="_blank"' : '';
    $nofollow = $settings['link_url']['nofollow'] ? ' rel="nofollow"' : '';
    echo '<div class="link-box ' . $settings['link_align'] . '">';
    echo '<a class="colored-link" href="'. $settings['link_url']['url'] .'" '. $target . $nofollow .'>'. $settings['link_text'] .'</a>';
    echo '</div>';
  }

}

// Register widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Color_Link_Widget() );
