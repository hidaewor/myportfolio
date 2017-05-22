<?php /**
 * Register color schemes for Edge.
 *
 * Can be filtered with {@see 'edge_color_schemes'}.
 *
 * The order of colors in a colors array:
 * @since Edge 1.1
 *
 * @return array An associative array of color scheme options.
 */
function edge_get_color_schemes() {
	return apply_filters( 'edge_color_schemes', array(
		'default_color' => array(
			'label'  => __( '--Default--', 'edge' ),
			'colors' => array(
				'#c69f70',
				'#c69f70',
				'#c69f70',
				'#c69f70',

			),
		),
		'dark'    => array(
			'label'  => __( 'Dark', 'edge' ),
			'colors' => array(
				'#c69f70',
				'#111111',
				'#111111',
				'#111111',

			),
		),
		'yellow'  => array(
			'label'  => __( 'Yellow', 'edge' ),
			'colors' => array(
				'#c69f70',
				'#ffae00',
				'#ffae00',
				'#ffae00',
				
			),
		),
		'pink'    => array(
			'label'  => __( 'Pink', 'edge' ),
			'colors' => array(
				'#c69f70',
				'#f52e5d',
				'#f52e5d',
				'#f52e5d',


			),
		),
		'blue'   => array(
			'label'  => __( 'Blue', 'edge' ),
			'colors' => array(
				'#c69f70',
				'#009eed',
				'#009eed',
				'#009eed',

			),
		),
		'purple'   => array(
			'label'  => __( 'Purple', 'edge' ),
			'colors' => array(
				'#c69f70',
				'#9651cc',
				'#9651cc',
				'#9651cc',

			),
		),
		'vanburenborwn'    => array(
			'label'  => __( 'Van Buren Brown', 'edge' ),
			'colors' => array(
				'#c69f70',
				'#a57a6b',
				'#a57a6b',
				'#a57a6b',


			),
		),
	) );
}

if ( ! function_exists( 'edge_get_color_scheme' ) ) :
/**
 * Get the current Edge color scheme.
 *
 * @since Edge 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function edge_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default_color' );
	$color_schemes       = edge_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default_color']['colors'];
}
endif;

if ( ! function_exists( 'edge_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for Edge.
 *
 * @since Edge 1.0
 *
 * @return array Array of color schemes.
 */
function edge_get_color_scheme_choices() {
	$color_schemes                = edge_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // edge_get_color_scheme_choices

if ( ! function_exists( 'edge_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since Edge 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function edge_sanitize_color_scheme( $value ) {
	$color_schemes = edge_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default_color';
	}

	return $value;
}
endif; // edge_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Edge 1.0
 *
 * @see wp_add_inline_style()
 */
function edge_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default_color' );

	// Don't do anything if the default_color color scheme is selected.
	if ( 'default_color' === $color_scheme_option ) {
		return;
	}

	$color_scheme = edge_get_color_scheme();

	$colors = array(
		'site_page_nav_link_title_color'        => get_theme_mod('site_page_nav_link_title_color',$color_scheme[3]),
		'edge_button_color'    => get_theme_mod('edge_button_color',$color_scheme[3]),
		'edge_woocommerce_color'        => get_theme_mod('edge_woocommerce_color',$color_scheme[3]),
	);

	$color_scheme_css = edge_get_color_scheme_css( $colors );

	wp_add_inline_style( 'edge-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'edge_color_scheme_css' );

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Edge 1.0
 */
function edge_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls' ), '20140108', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', edge_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'edge_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Edge 1.0.4
 */
function edge_customize_preview_js() {
	wp_enqueue_script( 'edge-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}

add_action( 'customize_preview_init', 'edge_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Edge 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function edge_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'site_page_nav_link_title_color'        => '#c69f70',
		'edge_button_color'    => '#c69f70',
		'edge_woocommerce_color'        => '#c69f70',
		
	) );
	$css = <<<CSS
	/****************************************************************/
						/*.... Color Style ....*/
	/****************************************************************/
	/* Nav and links hover */
	a,
	ul li a:hover,
	ol li a:hover,
	.top-header .widget_contact ul li a:hover, /* Top Header Widget Contact */
	.main-navigation a:hover, /* Navigation */
	.main-navigation ul li.current-menu-item a,
	.main-navigation ul li.current_page_ancestor a,
	.main-navigation ul li.current-menu-ancestor a,
	.main-navigation ul li.current_page_item a,
	.main-navigation ul li:hover > a,
	.main-navigation li.current-menu-ancestor.menu-item-has-children > a:after,
	.main-navigation li.current-menu-item.menu-item-has-children > a:after,
	.main-navigation ul li:hover > a:after,
	.main-navigation li.menu-item-has-children > a:hover:after,
	.main-navigation li.page_item_has_children > a:hover:after,
	.main-navigation ul li ul li a:hover,
	.main-navigation ul li ul li:hover > a,
	.main-navigation ul li.current-menu-item ul li a:hover,
	.header-search:hover, .header-search-x:hover, /* Header Search Form */
	.entry-title a:hover, /* Post */
	.entry-title a:focus,
	.entry-title a:active,
	.entry-meta span:hover,
	.entry-meta a:hover,
	.cat-links,
	.cat-links a,
	.tag-links,
	.tag-links a,
	.entry-meta .entry-format a,
	.entry-format:before,
	.entry-meta .entry-format:before,
	.entry-header .entry-meta .entry-format:before,
	.widget ul li a:hover,/* Widgets */
	.widget-title a:hover,
	.widget_contact ul li a:hover,
	.site-info .copyright a:hover, /* Footer */
	#colophon .widget ul li a:hover,
	#footer-navigation a:hover {
		color: {$colors['site_page_nav_link_title_color']};
	}

	.cat-links,
	.tag-links {
		border-bottom: 1px solid {$colors['site_page_nav_link_title_color']};
	}

	/* Webkit */
	::selection {
		background: {$colors['site_page_nav_link_title_color']};
		color: #fff;
	}
	/* Gecko/Mozilla */
	::-moz-selection {
		background: {$colors['site_page_nav_link_title_color']};
		color: #fff;
	}


	/* Accessibility
	================================================== */
	.screen-reader-text:hover,
	.screen-reader-text:active,
	.screen-reader-text:focus {
		background-color: #f1f1f1;
		color: {$colors['site_page_nav_link_title_color']};
	}

	/* Buttons reset, button, submit */

	input[type="reset"],/* Forms  */
	input[type="button"],
	input[type="submit"],
	.go-to-top a:hover {
		background-color:{$colors['edge_button_color']};
	}

	/* Default Buttons */
	.btn-default:hover,
	.vivid,
	.search-submit {
		background-color: {$colors['edge_button_color']};
		border: 1px solid {$colors['edge_button_color']};
	}
	.go-to-top a {
		border: 2px solid {$colors['edge_button_color']};
		color: {$colors['edge_button_color']};
	}

	#colophon .widget-title:after {
		background-color: {$colors['edge_button_color']};
	}

	/* -_-_-_ Not for change _-_-_- */
	.light-color:hover,
	.vivid:hover {
		background-color: #fff;
		border: 1px solid #fff;
	}

	ul.default-wp-page li a {
		color: {$colors['edge_button_color']};
	}

	#bbpress-forums .bbp-topics a:hover {
	color: {$colors['edge_button_color']};
	}
	.bbp-submit-wrapper button.submit {
		background-color: {$colors['edge_button_color']};
		border: 1px solid {$colors['edge_button_color']};
	}

	/* Woocommerce
	================================================== */
	.woocommerce #respond input#submit, 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button,
	.woocommerce #respond input#submit.alt, 
	.woocommerce a.button.alt, 
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt,
	.woocommerce-demo-store p.demo_store {
		background-color: {$colors['edge_woocommerce_color']};
	}
	.woocommerce .woocommerce-message:before {
		color: {$colors['edge_woocommerce_color']};
	}

CSS;

	return $css;
}
function edge_color_scheme_css_template() {
	$colors = array(

		// Color Styles
		'site_page_nav_link_title_color'        => '{{ data.site_page_nav_link_title_color }}',
		'edge_button_color'    => '{{ data.edge_button_color }}',
		'edge_woocommerce_color'        => '{{ data.edge_woocommerce_color }}',
	);
	?>
	<script type="text/html" id="tmpl-edge-color-scheme">
		<?php echo edge_get_color_scheme_css( $colors ); ?>
	</script>
<?php
}
add_action( 'customize_controls_print_footer_scripts', 'edge_color_scheme_css_template' );
?>