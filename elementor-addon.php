<?php
/**
 * Plugin Name: Elementor Addon
 * Description: Simple widgets for Elementor.
 * Version:     1.0.0
 * Author:      Adam Walker
 * Author URI:  https://adamwalker.live/
 * Text Domain: elementor-addon
 */

 //$plugin_images = plugin_dir_url(__FILE__) . 'assets/images'; /*the . is concatenation */

 /*if (!defined('ABSPATH')) { /*Some kind of security protection, if anyone tries to run this code outside of a wordpress 
	interface, the program just exits?
    exit; //Exit if accessed directly
}*/


/**
 * Adding a custom category
 */

 /*public*/ /*function add_elementor_widget_categories($elements_manager) {

	$elements_manager->add_category (
	  'b2w_category',
	  [
		'title' => __('Bootstrap to WordPress','elementor-addon'),
		'icon' => 'eicon-nerd',
	  ]
	);
 
  } */


  function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'custom-widgets',
		[
			'title' => esc_html__( 'My Custom Widgets', 'elementor-addon' ),
			'icon' => 'fa fa-plug',
		]
	);
	/*$elements_manager->add_category(
		'second-category',
		[
			'title' => esc_html__( 'Second Category', 'textdomain' ),
			'icon' => 'fa fa-plug',
		]
	); */

}


function register_hello_world_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/hello-world-widget-1.php' );
	require_once( __DIR__ . '/widgets/hello-world-widget-2.php' );
    require_once( __DIR__ . '/widgets/class-buttons.php' );

	$widgets_manager->register( new \Elementor_Hello_World_Widget_1() );
	$widgets_manager->register( new \Elementor_Hello_World_Widget_2() );
    $widgets_manager->register( new \B2w_Buttons_Widget() );
}

add_action( 'elementor/widgets/register', 'register_hello_world_widget' );
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );