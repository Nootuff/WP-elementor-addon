<?php
/**
 * Call to Action Widget
 */

 class Call_To_Action_Widget extends \Elementor\Widget_Base {


   public function get_name() {
 		return 'cta';  
 	}

 	public function get_title() {
 		return __( 'Call to Action Card', 'elementor-addon' );
 	}

 	public function get_icon() {
 		return 'eicon-call-to-action';
 	}

 	public function get_keywords() {
 		return [ 'action', 'call to', 'cta' ];
 	}

 	public function get_categories() {
 		return [ 'custom-widgets' ];
 	}


  protected function _register_controls() {
    global $plugin_images; /*This is the php variable in the main php file, it links to the assets/images folder 
    
    */

    $this->start_controls_section(
      'cta_controls',
      [
        'label' => __( 'Call to Action', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
			'sub_title_text',
      [
				'label' => __('Sub Title Text', 'elementor-addon'),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __('Sub Title Goes HERE', 'elementor-addon' ),
				'default' => __( 'JOIN 49,000 STUDENTS', 'elementor-addon' ),
			]
    );

    $this->add_control(
			'sub_title_color',
      [
        'label' => __( 'Sub Title Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
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
        'placeholder' => __('CTA Title', 'elementor-addon' ),
        'default' => __( 'Elementor Addon with Adam Walker', 'elementor-addon' ),
      ]
    );

    $this->add_control(
			'title_color',
      [
        'label' => __( 'Title Colour', 'elementor-addon' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ffffff',
        'selectors' => [
					'{{WRAPPER}} h2' => 'color: {{VALUE}}',
				],
      ]
    );

    $this->add_control(
			'cta_desc',
			[
        'label' => __('Description', 'elementor-addon'),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __('Description', 'elementor-addon' ),
        'default' => __( 'Learn how to design and build custom, beautiful & responsive WordPress websites and themes for beginners TODAY!', 'elementor-addon' ),
      ]
    );

    $this->add_control(
      'desc_color',
      [
        'label' => __( 'Description Colour', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
        'selectors' => [
					'{{WRAPPER}} .cta-desc' => 'color: {{VALUE}}',
				],
      ]
    );

    $this->add_control(
			'overlay_image',
			[
				'label' => __( 'Choose Image', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					//'url' => \Elementor\Utils::get_placeholder_image_src(),
                    'url' => $plugin_images . '/card-css.png', /*$plugin_images is the variable you imported at the top
                    of this control section*/
				],
			]
		);

    $this->add_control(
			'button_text',
			[
				'label' => __('Button Text', 'elementor-addon'),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __('Button Text', 'elementor-addon' ),
				'default' => __( 'Join Now ->', 'elementor-addon' ),

			]
		);

    $this->add_control(
			'button_link',
			[
				'label' => __( 'Button Link', 'elementor-addon' ),
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
			'btn_style',
			[
				'label' => __( 'Button Style', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'btn-primary',
				'options' => [
					'btn-primary'  => __( 'Primary', 'elementor-addon' ),
					'btn-secondary' => __( 'Secondary', 'elementor-addon' ),
					'btn-invert' => __( 'Invert', 'elementor-addon' ),
				],
			]
		);

    $this->add_control(
      'btn_align',
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
        'default' => 'text-center',
        'toggle' => true,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Background::get_type(),
      [
        'name' => 'background',
        'label' => __( 'Background', 'elementor-addon' ),
        'types' => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .overlay',
      ]
    );

    $this->end_controls_section();

  }

	protected function render() {
    global $plugin_images; 
    $settings = $this->get_settings_for_display(); //Ths pulls in all of the controls
    $target = $settings['button_link']['is_external'] ? ' target="_blank"' : ''; //Ternary operator.
    $nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';

  echo '<div class="section-call-to-action">';

    echo '<div class="overlay">';
      echo '<div class="overlay-image"><img src="'. esc_url( $settings['overlay_image']['url'] ) .'"></div>';
    echo '</div>';

    echo '<div class="underlay-bg"></div>';

    echo '<p class="sub-title">'. $settings['sub_title_text'] .'</p>';
    echo '<h2>'. $settings['title_text'] .'</h2>';
    echo '<p class="cta-desc">'. $settings['cta_desc'] .'</p>';
    echo '<div class="link-box '. $settings['btn_align'] .'">';
      echo '<a href="'. $settings['button_link']['url'] .'" ' . $target . $nofollow . ' class="btn '. $settings['btn_style'] .'">'.$settings['button_text'].'</a>';
    echo '</div>';
  echo '</div>';

  }


 }

 // Register widget
 \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Call_To_Action_Widget() );
