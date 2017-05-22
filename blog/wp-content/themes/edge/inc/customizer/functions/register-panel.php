<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */
/******************** EDGE CUSTOMIZE REGISTER *********************************************/
add_action( 'customize_register', 'edge_customize_register_wordpress_default' );
function edge_customize_register_wordpress_default( $wp_customize ) {
	$wp_customize->add_panel( 'edge_wordpress_default_panel', array(
		'priority' => 5,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Edge WordPress Settings', 'edge' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'edge_customize_register_options', 20 );
function edge_customize_register_options( $wp_customize ) {
	$wp_customize->add_panel( 'edge_options_panel', array(
		'priority' => 6,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Edge Theme Options', 'edge' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'edge_customize_register_featuredcontent' );
function edge_customize_register_featuredcontent( $wp_customize ) {
	$wp_customize->add_panel( 'edge_featuredcontent_panel', array(
		'priority' => 7,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Edge Slider Options', 'edge' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'edge_customize_register_widgets' );
function edge_customize_register_widgets( $wp_customize ) {
	$wp_customize->add_panel( 'widgets', array(
		'priority' => 8,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Edge Widgets', 'edge' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'edge_customize_register_colors' );
function edge_customize_register_colors( $wp_customize ) {
	$wp_customize->add_panel( 'colors', array(
		'priority' => 9,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Edge Colors', 'edge' ),
		'description' => '',
	) );
}
?>