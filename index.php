<?php
/**
 * Plugin Name: Scrolling Testimonial
 * Plugin URI: aomanansala.io
 * Description: Create testimonial post type and display it using carousel
 * Version: 1.0.0
 * Author: Alvin Manansala
 * Author URI: http://aomanansala.io
 * License: GPL2
 */

register_activation_hook( __FILE__, 'st_activate' );
register_deactivation_hook( __FILE__, 'st_deactivate' );

function st_setup_post_type() {
	include_once('cmb2/cmb.php');
	include_once('st_shortcode.php');
	
    $labels = array(
		'name' => _x('Testimonials', 'post type general name'),
		'singular_name' => _x('Testimonial', 'post type singular name'),
		'add_new' => _x('Add New', 'career'),
		'add_new_item' => __('Testimonial'),
		'edit_item' => __('Edit Testimonial'),
		'new_item' => __('New Testimonial'),
		'view_item' => __('View Testimonial'),
		'search_items' => __('Search Testimonial'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'menu_position' => null,
		'supports' => array( 'title', 'thumbnail')
	); 
 
	register_post_type( 'testimonials' , $args );
}
add_action( 'init', 'st_setup_post_type' );

function st_enqueue_scripts() {
    wp_register_script( 'owl.carousel', plugin_dir_url(__FILE__) . 'assets/js/owl.carousel.min.js', array( 'jquery' ), '1', false );  
	wp_enqueue_script( 'owl.carousel' );  

	wp_register_script( 'owl.init', plugin_dir_url(__FILE__) . 'assets/js/owl.init.js', array( 'jquery' ), '1', false );  
	wp_enqueue_script( 'owl.init' );  
}
add_action( 'wp_enqueue_scripts', 'st_enqueue_scripts' );

function st_enqueue_styles() {
	wp_register_style( 'owl.styles', plugin_dir_url(__FILE__) . 'assets/css/owl.styles.css', array(), '1', 'all' );
    wp_enqueue_style( 'owl.styles' );

	wp_register_style( 'owl.carousel', plugin_dir_url(__FILE__) . 'assets/css/owl.carousel.css', array(), '1', 'all' );
    wp_enqueue_style( 'owl.carousel' );

    wp_register_style( 'owl.theme', plugin_dir_url(__FILE__) . 'assets/css/owl.theme.css', array(), '1', 'all' );
    wp_enqueue_style( 'owl.theme' );
}
add_action( 'wp_enqueue_scripts', 'st_enqueue_styles' );
 
function st_activate() {
    st_setup_post_type();
    st_enqueue_scripts();
    flush_rewrite_rules();
}

function st_deactivate() {
    flush_rewrite_rules();
}

