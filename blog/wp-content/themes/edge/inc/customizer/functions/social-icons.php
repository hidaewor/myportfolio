<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */
$edge_settings = edge_get_theme_options();
/******************** EDGE SOCIAL ICONS ******************************************/
$wp_customize->add_section( 'edge_social_icons', array(
	'title' => __('Social Icons','edge'),
	'priority' => 400,
	'panel' =>'edge_options_panel'
));
$wp_customize->add_setting( 'edge_theme_options[edge_social_facebook]', array(
	'default' => $edge_settings['edge_social_facebook'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'edge_theme_options[edge_social_facebook]', array(
	'priority' => 410,
	'label' => __( 'Facebook Link', 'edge' ),
	'section' => 'edge_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'edge_theme_options[edge_social_twitter]', array(
	'default' => $edge_settings['edge_social_twitter'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'edge_theme_options[edge_social_twitter]', array(
	'priority' => 420,
	'label' => __( 'Twitter Link', 'edge' ),
	'section' => 'edge_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'edge_theme_options[edge_social_pinterest]', array(
	'default' => $edge_settings['edge_social_pinterest'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'edge_theme_options[edge_social_pinterest]', array(
	'priority' => 430,
	'label' => __( 'Pinterest Link', 'edge' ),
	'section' => 'edge_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'edge_theme_options[edge_social_dribbble]', array(
	'default' => $edge_settings['edge_social_dribbble'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'edge_theme_options[edge_social_dribbble]', array(
	'priority' => 440,
	'label' => __( 'Dribbble Link', 'edge' ),
	'section' => 'edge_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'edge_theme_options[edge_social_instagram]', array(
	'default' => $edge_settings['edge_social_instagram'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'edge_theme_options[edge_social_instagram]', array(
	'priority' => 450,
	'label' => __( 'Instagram Link', 'edge' ),
	'section' => 'edge_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'edge_theme_options[edge_social_flickr]', array(
	'default' => $edge_settings['edge_social_flickr'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'edge_theme_options[edge_social_flickr]', array(
	'priority' => 460,
	'label' => __( 'Flickr Link', 'edge' ),
	'section' => 'edge_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'edge_theme_options[edge_social_googleplus]', array(
	'default' => $edge_settings['edge_social_googleplus'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'edge_theme_options[edge_social_googleplus]', array(
	'priority' => 470,
	'label' => __( 'Google Plus Link', 'edge' ),
	'section' => 'edge_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'edge_theme_options[edge_social_linkedin]', array(
	'default' => $edge_settings['edge_social_linkedin'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'edge_theme_options[edge_social_linkedin]', array(
	'priority' => 480,
	'label' => __( 'Linkedin Link', 'edge' ),
	'section' => 'edge_social_icons',
	'type' => 'text',
	)
);
	?>