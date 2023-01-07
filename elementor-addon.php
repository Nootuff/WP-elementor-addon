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

function register_hello_world_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/hello-world-widget-1.php' );
	require_once( __DIR__ . '/widgets/hello-world-widget-2.php' );
    require_once( __DIR__ . '/widgets/class-buttons.php' );

	$widgets_manager->register( new \Elementor_Hello_World_Widget_1() );
	$widgets_manager->register( new \Elementor_Hello_World_Widget_2() );
    $widgets_manager->register( new \B2w_Buttons_Widget() );
}
add_action( 'elementor/widgets/register', 'register_hello_world_widget' );