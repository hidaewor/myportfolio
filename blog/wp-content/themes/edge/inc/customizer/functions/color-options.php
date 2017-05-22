<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.1
 */
/********************* Color Option **********************************************/
	$wp_customize->add_section( 'colors', array(
		'title' 						=> __('Color Options','edge'),
		'priority'					=> 90,
		'panel'					=>'colors'
	));
	$color_scheme = edge_get_color_scheme();
	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default_color',
		'sanitize_callback' => 'edge_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'description'    => __( 'Select Color Style', 'edge' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => edge_get_color_scheme_choices(),
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'site_page_nav_link_title_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_page_nav_link_title_color', array(
		'description'       => __( 'Nav and links', 'edge' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'edge_button_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'edge_button_color', array(
		'description'       => __( 'Buttons Reset/ Submit', 'edge' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'edge_woocommerce_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'edge_woocommerce_color', array(
		'description'       => __( 'WooCommerce', 'edge' ),
		'section'     => 'colors',
	) ) );
?>