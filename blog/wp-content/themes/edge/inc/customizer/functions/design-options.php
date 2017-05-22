<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */
$edge_settings = edge_get_theme_options();
/******************** EDGE LAYOUT OPTIONS ******************************************/
	$wp_customize->add_section('edge_layout_options', array(
		'title' => __('Layout Options', 'edge'),
		'priority' => 102,
		'panel' => 'edge_options_panel'
	));
	$wp_customize->add_setting('edge_theme_options[edge_responsive]', array(
		'default' => $edge_settings['edge_responsive'],
		'sanitize_callback' => 'edge_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('edge_theme_options[edge_responsive]', array(
		'priority' =>10,
		'label' => __('Responsive Layout', 'edge'),
		'section' => 'edge_layout_options',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'on' => __('ON ','edge'),
			'off' => __('OFF','edge'),
		),
	));
	$wp_customize->add_setting('edge_theme_options[edge_disable_big_letter]', array(
		'default' => $edge_settings['edge_disable_big_letter'],
		'sanitize_callback' => 'edge_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('edge_theme_options[edge_disable_big_letter]', array(
		'priority' =>10,
		'label' => __('Disable Big letter', 'edge'),
		'section' => 'edge_layout_options',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'on' => __('ON ','edge'),
			'off' => __('OFF','edge'),
		),
	));
	$wp_customize->add_setting('edge_theme_options[edge_blog_layout]', array(
		'default' => $edge_settings['edge_blog_layout'],
		'sanitize_callback' => 'edge_sanitize_select',
		'type' => 'option',
	));

	$wp_customize->add_control('edge_theme_options[edge_blog_layout]', array(
		'priority' =>30,
		'label' => __('Blog Layout', 'edge'),
		'section'    => 'edge_layout_options',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'large_image_display' => __('Blog Large Image Display','edge'),
			'medium_image_display' => __('Blog Medium Image Display','edge'),
			'single_column_blog'	=> __('Single Column Blog Display','edge'),
		),
	));
	$wp_customize->add_setting( 'edge_theme_options[edge_entry_format_blog]', array(
		'default' => $edge_settings['edge_entry_format_blog'],
		'sanitize_callback' => 'edge_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control( 'edge_theme_options[edge_entry_format_blog]', array(
		'priority'=>40,
		'label' => __('Disable Entry Format from Blog Page', 'edge'),
		'section' => 'edge_layout_options',
		'type' => 'select',
		'choices' => array(
		'show' => __('Display Entry Format','edge'),
		'hide' => __('Hide Entry Format','edge'),
		'show-button' => __('Show Button Only','edge'),
		'hide-button' => __('Hide Button Only','edge'),
	),
	));
	$wp_customize->add_setting( 'edge_theme_options[edge_entry_meta_blog]', array(
		'default' => $edge_settings['edge_entry_meta_blog'],
		'sanitize_callback' => 'edge_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control( 'edge_theme_options[edge_entry_meta_blog]', array(
		'priority'=>45,
		'label' => __('Disable Entry Meta from Blog Page', 'edge'),
		'section' => 'edge_layout_options',
		'type'	=> 'select',
		'choices' => array(
		'show-meta' => __('Display Entry Meta','edge'),
		'hide-meta' => __('Hide Entry Meta','edge'),
	),
	));
	$wp_customize->add_setting('edge_theme_options[edge_design_layout]', array(
		'default'        => $edge_settings['edge_design_layout'],
		'sanitize_callback' => 'edge_sanitize_select',
		'type'                  => 'option',
	));
	$wp_customize->add_control('edge_theme_options[edge_design_layout]', array(
	'priority'  =>50,
	'label'      => __('Design Layout', 'edge'),
	'section'    => 'edge_layout_options',
	'type'       => 'select',
	'checked'   => 'checked',
	'choices'    => array(
		'wide-layout' => __('Full Width Layout','edge'),
		'boxed-layout' => __('Boxed Layout','edge'),
		'small-boxed-layout' => __('Small Boxed Layout','edge'),
	),
));
?>