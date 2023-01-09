<?php
/**
 *  Button Widget
 */

class Buttons_Widget extends \Elementor\Widget_Base
{

  //Find out what to put in these fields here: https://developers.elementor.com/docs/widgets/widget-data/

  public function get_name()
  { //This name is just used in the code.
    return 'buttons';
  }

  public function get_title()
  { //This is the name that will actually show up in the elements sidebar
    return __('Elementor Button Test', 'elementor-addon');
  }

  public function get_icon()
  { /*This is a string, eicon is an icon library like fontawesome. method is an optional, 
   but recommended, method. It lets you set the widget icon. You can use any 
   Elementor icons (https://elementor.github.io/elementor-icons/) or 
   FontAwesome icons , to simply return the CSS class name. */
    return 'eicon-button';
  }

  public function get_keywords()
  { /*Assign keywords to the widget that will help you 
   find it when you use the widget search field*/
    return ['button', 'link', 'ui', 'cta'];
  }

  public function get_categories()
  {
    return [ /*'basic' */'custom-widgets']; //your custom category
  }

  protected function _register_controls()
  { //More info here: https://developers.elementor.com/docs/controls/control-values/
// More info on control types here:  https://developers.elementor.com/docs/editor-controls/control-types/ 
    $this->start_controls_section(
      'buttons_controls',
      [
        'label' => __('Button', 'elementor-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    // add our controls

    $this->add_control(
      'button_text',
      [
        'label' => __('Button Text', 'elementor-addon'),
        'label_block' => true,
        'placeholder' => __('Type something special here, my friend!', 'elementor-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        //This is a text type control
        'default' => __('Test text', 'elementor-addon'),
        //Default text on the button
      ]
    );

    $this->add_control(
      //this is another control to set the url the button will link to. 
      'button_link',
      [
        'label' => __('Button Link', 'elementor-addon'),
        'type' => \Elementor\Controls_Manager::URL,
        'is_external' => true,
        'default' => [
          'url' => '#',
          'is_external' => true,
          /*Set this to tell the code whether this link is to an external 
          page or an external site, set to false for an internal link*/
          'nofollow' => false //This is for SEO or something
        ],
      ]
    );

    $this->add_control(
      //Lets you set the button color style.
      'button_style',
      [
        'label' => __('Button Style', 'elementor-addon'),
        'type' => \Elementor\Controls_Manager::SELECT,
        //This is a dropdown control.
        'default' => 'btn-primary',
        //This is a css class for bootstrap
        'label_block' => 'true',
        //This changes the label to display block not inline.
        'options' => [
          //These are all classes that can be selected as options, they change the color
          'btn-primary' => __('Primary', 'elementor-addon'),
          'btn-danger' => __('Danger', 'pelementor-addon'),
          'btn-success' => __('success', 'elementor-addon'),
        ],
      ],
    );

    $this->add_responsive_control(
      //These are the bootstrap button alignment controls. 
      'button_align',
      [
        'label' => __('Alignment', 'elementor-addon'),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [

          'left' => [
            'title' => __('Left', 'elementor-addon'),
            'icon' => 'eicon-text-align-left',
          ],

          'center' => [
            'title' => __('Center', 'elementor-addon'),
            'icon' => 'eicon-text-align-center',
          ],

          'right' => [
            'title' => __('Right', 'elementor-addon'),
            'icon' => 'eicon-text-align-right',
          ],

        ],

        'devices' => ['desktop', 'tablet', 'mobile'],
        'default' => 'left',
        'selectors' => [
          '{{WRAPPER}} .link-box' => 'text-align: {{VALUE}};',
        ],
        'toggle' => true,

      ],
    );


    $this->end_controls_section();

  }

  protected function render()
  {

    $settings = $this->get_settings_for_display();
    $target = $settings['button_link']['is_external'] ? ' target="_blank"' : ''; /*Gets the settings from the
           functions up above. Look at the layout of this php variable, its a ternary operator! 
           If is_external = true, set target=blank */
    $nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';

    echo '<div class="link-box">';
    echo '<a href="' . $settings['button_link']['url'] . '" ' . $target . $nofollow . ' class="btn ' . $settings['button_style'] . '">' . $settings['button_text'] . '</a>';
    /*In the element above, the . are concatenation. The $ denotes a php variable
    the a element is being constructed out of values taken out of the controls up above? The echo is how php puts
    html onto pages?
    */
    echo '</div>';


  }

}


// Register widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Buttons_Widget()); //Notice the name is the same as the class up above.
