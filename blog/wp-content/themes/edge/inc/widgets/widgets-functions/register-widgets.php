<?php
/**
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */
/**************** EDGE REGISTER WIDGETS ***************************************/
add_action('widgets_init', 'edge_widgets_init');
function edge_widgets_init() {
	register_widget( "edge_contact_widgets" );

	register_sidebar(array(
			'name' => __('Main Sidebar', 'edge'),
			'id' => 'edge_main_sidebar',
			'description' => __('Shows widgets at Main Sidebar.', 'edge'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_sidebar(array(
			'name' => __('Display Contact Info at Header ', 'edge'),
			'id' => 'edge_header_info',
			'description' => __('Shows widgets on all page.', 'edge'),
			'before_widget' => '<aside id="%1$s" class="widget widget_contact">',
			'after_widget' => '</aside>',
		));
	register_sidebar(array(
			'name' => __('Contact Page Sidebar', 'edge'),
			'id' => 'edge_contact_page_sidebar',
			'description' => __('Shows widgets on Contact Page Template.', 'edge'),
			'before_widget' => '<aside id="%1$s" class="widget widget_contact">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Shortcode For Contact Page', 'edge'),
			'id' => 'edge_form_for_contact_page',
			'description' => __('Add Contact Form 7 Shortcode using text widgets Ex: [contact-form-7 id="137" title="Contact form 1"]', 'edge'),
			'before_widget' => '<div id="A%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_sidebar(array(
			'name' => __('WooCommerce Sidebar', 'edge'),
			'id' => 'edge_woocommerce_sidebar',
			'description' => __('Add WooCommerce Widgets Only', 'edge'),
			'before_widget' => '<div id="A%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	global $edge_settings;
	$edge_settings = wp_parse_args( get_option( 'edge_theme_options', array() ), edge_get_option_defaults_values() );
	for($i =1; $i<= $edge_settings['edge_footer_column_section']; $i++){
	register_sidebar(array(
			'name' => __('Footer Column ', 'edge') . $i,
			'id' => 'edge_footer_'.$i,
			'description' => __('Shows widgets at Footer Column ', 'edge').$i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}
}
?>