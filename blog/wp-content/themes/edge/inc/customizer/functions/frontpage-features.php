<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */
/******************** EDGE FRONTPAGE  *********************************************/
$edge_settings = edge_get_theme_options();
$wp_customize->add_section( 'edge_frontpage_features', array(
	'title' => __('Display FrontPage Features','edge'),
	'priority' => 400,
	'panel' =>'edge_options_panel'
));
$wp_customize->add_setting( 'edge_theme_options[edge_disable_features]', array(
	'default' => $edge_settings['edge_disable_features'],
	'sanitize_callback' => 'edge_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'edge_theme_options[edge_disable_features]', array(
	'priority' => 405,
	'label' => __('Disable in Front Page', 'edge'),
	'section' => 'edge_frontpage_features',
	'type' => 'checkbox',
));
for ( $i=1; $i <= $edge_settings['edge_total_features'] ; $i++ ) {
	$wp_customize->add_setting('edge_theme_options[edge_frontpage_features_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'edge_sanitize_page',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control( 'edge_theme_options[edge_frontpage_features_'. $i .']', array(
		'priority' => 420 . $i,
		'label' => __(' Feature #', 'edge') . ' ' . $i ,
		'section' => 'edge_frontpage_features',
		'type' => 'dropdown-pages',
	));
}
?>