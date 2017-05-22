<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */
$edge_settings = edge_get_theme_options();
/********************  EDGE THEME OPTIONS ******************************************/
	$wp_customize->add_section('title_tagline', array(
	'title' => __('Site Title & Logo Options', 'edge'),
	'priority' => 10,
	'panel' => 'edge_wordpress_default_panel'
	));
	$wp_customize->add_setting('edge_theme_options[edge_header_display]', array(
		'capability' => 'edit_theme_options',
		'default' => $edge_settings['edge_header_display'],
		'sanitize_callback' => 'edge_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('edge_theme_options[edge_header_display]', array(
		'label' => __('Site Logo/ Text Options', 'edge'),
		'priority' => 102,
		'section' => 'title_tagline',
		'type' => 'select',
		'checked' => 'checked',
			'choices' => array(
			'header_text' => __('Display Site Title Only','edge'),
			'header_logo' => __('Display Site Logo Only','edge'),
			'show_both' => __('Show Both','edge'),
			'disable_both' => __('Disable Both','edge'),
		),
	));
	$wp_customize->add_section('header_image', array(
	'title' => __('Header Image', 'edge'),
	'priority' => 20,
	'panel' => 'edge_wordpress_default_panel'
	));
	$wp_customize->add_section('edge_custom_header', array(
		'title' => __('Edge Options', 'edge'),
		'priority' => 503,
		'panel' => 'edge_options_panel'
	));
	$wp_customize->add_setting( 'edge_theme_options[edge_search_custom_header]', array(
		'default' => $edge_settings['edge_search_custom_header'],
		'sanitize_callback' => 'edge_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'edge_theme_options[edge_search_custom_header]', array(
		'priority'=>20,
		'label' => __('Disable Search Form', 'edge'),
		'section' => 'edge_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'edge_theme_options[edge_stick_menu]', array(
		'default' => $edge_settings['edge_stick_menu'],
		'sanitize_callback' => 'edge_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'edge_theme_options[edge_stick_menu]', array(
		'priority'=>30,
		'label' => __('Disable Stick Menu', 'edge'),
		'section' => 'edge_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'edge_theme_options[edge_scroll]', array(
		'default' => $edge_settings['edge_scroll'],
		'sanitize_callback' => 'edge_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'edge_theme_options[edge_scroll]', array(
		'priority'=>40,
		'label' => __('Disable Goto Top', 'edge'),
		'section' => 'edge_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'edge_theme_options[edge_top_social_icons]', array(
		'default' => $edge_settings['edge_top_social_icons'],
		'sanitize_callback' => 'edge_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'edge_theme_options[edge_top_social_icons]', array(
		'priority'=>40,
		'label' => __('Disable Top Social Icons', 'edge'),
		'section' => 'edge_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'edge_theme_options[edge_buttom_social_icons]', array(
		'default' => $edge_settings['edge_buttom_social_icons'],
		'sanitize_callback' => 'edge_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'edge_theme_options[edge_buttom_social_icons]', array(
		'priority'=>43,
		'label' => __('Disable Buttom Social Icons', 'edge'),
		'section' => 'edge_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'edge_theme_options[edge_display_page_featured_image]', array(
		'default' => $edge_settings['edge_display_page_featured_image'],
		'sanitize_callback' => 'edge_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'edge_theme_options[edge_display_page_featured_image]', array(
		'priority'=>48,
		'label' => __('Display Page Featured Image', 'edge'),
		'section' => 'edge_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'edge_theme_options[edge_reset_all]', array(
		'default' => $edge_settings['edge_reset_all'],
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'edge_reset_alls',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'edge_theme_options[edge_reset_all]', array(
		'priority'=>50,
		'label' => __('Reset all default settings. (Refresh it to view the effect)', 'edge'),
		'section' => 'edge_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_section( 'edge_custom_css', array(
		'title' => __('Enter your custom CSS', 'edge'),
		'priority' => 507,
		'panel' => 'edge_options_panel'
	));
	$wp_customize->add_setting( 'edge_theme_options[edge_custom_css]', array(
		'default' => $edge_settings['edge_custom_css'],
		'sanitize_callback' => 'edge_sanitize_custom_css',
		'type' => 'option',
		)
	);
	$wp_customize->add_control( 'edge_theme_options[edge_custom_css]', array(
		'label' => __('Custom CSS','edge'),
		'section' => 'edge_custom_css',
		'type' => 'textarea'
		)
	);
	$wp_customize->add_section('edge_footer_image', array(
		'title' => __('Footer Background Image', 'edge'),
		'priority' => 510,
		'panel' => 'edge_options_panel'
	));
	$wp_customize->add_setting( 'edge_theme_options[edge-img-upload-footer-image]',array(
		'default'	=> $edge_settings['edge-img-upload-footer-image'],
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type' => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'edge_theme_options[edge-img-upload-footer-image]', array(
		'label' => __('Footer Background Image','edge'),
		'description' => __('Image will be displayed on footer','edge'),
		'priority'	=> 50,
		'section' => 'edge_footer_image',
		)
	));
/********************** edge WORDPRESS DEFAULT PANEL ***********************************/
	$wp_customize->add_section('colors', array(
	'title' => __('Colors', 'edge'),
	'priority' => 30,
	'panel' => 'edge_wordpress_default_panel'
	));
	$wp_customize->add_section('background_image', array(
	'title' => __('Background Image', 'edge'),
	'priority' => 40,
	'panel' => 'edge_wordpress_default_panel'
	));
	$wp_customize->add_section('nav', array(
	'title' => __('Navigation', 'edge'),
	'priority' => 50,
	'panel' => 'edge_wordpress_default_panel'
	));
	$wp_customize->add_section('static_front_page', array(
	'title' => __('Static Front Page', 'edge'),
	'priority' => 60,
	'panel' => 'edge_wordpress_default_panel'
	));
?>