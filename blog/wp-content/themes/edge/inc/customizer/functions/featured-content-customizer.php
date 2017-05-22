<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */
/******************** EDGE SLIDER SETTINGS ******************************************/
$edge_settings = edge_get_theme_options();
$wp_customize->add_section( 'featured_content', array(
	'title' => __( 'Slider Settings', 'edge' ),
	'priority' => 140,
	'panel' => 'edge_featuredcontent_panel'
));
$wp_customize->add_setting( 'edge_theme_options[edge_enable_slider]', array(
	'default' => $edge_settings['edge_enable_slider'],
	'sanitize_callback' => 'edge_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'edge_theme_options[edge_enable_slider]', array(
	'priority'=>12,
	'label' => __('Enable Slider', 'edge'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
	'frontpage' => __('Front Page','edge'),
	'enitresite' => __('Entire Site','edge'),
	'disable' => __('Disable Slider','edge'),
),
));
$wp_customize->add_setting('edge_theme_options[edge_secondary_text]', array(
	'default' =>$edge_settings['edge_secondary_text'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('edge_theme_options[edge_secondary_text]', array(
	'priority' =>15,
	'label' => __('Secondary Button Text', 'edge'),
	'section' => 'featured_content',
	'type' => 'text',
));
$wp_customize->add_setting('edge_theme_options[edge_secondary_url]', array(
	'default' =>$edge_settings['edge_secondary_url'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('edge_theme_options[edge_secondary_url]', array(
	'priority' =>16,
	'label' => __('Secondary Button Url', 'edge'),
	'section' => 'featured_content',
	'type' => 'text',
));
$wp_customize->add_setting('edge_theme_options[edge_slider_content_bg_color]', array(
	'default' =>$edge_settings['edge_slider_content_bg_color'],
	'sanitize_callback' => 'edge_sanitize_select',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('edge_theme_options[edge_slider_content_bg_color]', array(
	'priority' =>20,
	'label' => __('Slider Content With background color', 'edge'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
	'on' => __('Show Background Color','edge'),
	'off' => __('Hide Background Color','edge'),
	),
));
$wp_customize->add_section( 'edge_page_post_options', array(
	'title' => __('Display Page Slider','edge'),
	'priority' => 200,
	'panel' =>'edge_featuredcontent_panel'
));
for ( $i=1; $i <= $edge_settings['edge_slider_no'] ; $i++ ) {
	$wp_customize->add_setting('edge_theme_options[edge_featured_page_slider_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'edge_sanitize_page',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control( 'edge_theme_options[edge_featured_page_slider_'. $i .']', array(
		'priority' => 220 . $i,
		'label' => __(' Page Slider #', 'edge') . ' ' . $i ,
		'section' => 'edge_page_post_options',
		'type' => 'dropdown-pages',
	));
}       
?>