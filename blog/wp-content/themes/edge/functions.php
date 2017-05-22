<?php
/**
 * Display all edge functions and definitions
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */

/************************************************************************************************/
if ( ! function_exists( 'edge_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function edge_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
			$content_width=790;
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on edge, use a find and replace
	 * to change 'edge' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'edge', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('post-thumbnails');

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Main Menu', 'edge' ),
		'footermenu' => __( 'Footer Menu', 'edge' ),
	) );

	/* 
	* Enable support for custom logo. 
	*
	*/ 
	add_theme_support( 'custom-logo', array(
		'flex-width' => true, 
		'flex-height' => true,
	) );

	//Indicate widget sidebars can use selective refresh in the Customizer. 
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Switch default core markup for comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'edge_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_editor_style( array( 'css/editor-style.css') );

	/**
	* Making the theme Woocommrece compatible
	*/

	add_theme_support( 'woocommerce' );
}
endif; // edge_setup
add_action( 'after_setup_theme', 'edge_setup' );

/***************************************************************************************/
function edge_content_width() {
	if ( is_page_template( 'page-templates/gallery-template.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1170;
	}
}
add_action( 'template_redirect', 'edge_content_width' );

/***************************************************************************************/
if(!function_exists('edge_get_theme_options')):
	function edge_get_theme_options() {
	    return wp_parse_args(  get_option( 'edge_theme_options', array() ), edge_get_option_defaults_values() );
	}
endif;

/***************************************************************************************/
require get_template_directory() . '/inc/customizer/edge-default-values.php';
require( get_template_directory() . '/inc/settings/edge-functions.php' );
require( get_template_directory() . '/inc/settings/edge-common-functions.php' );
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/footer-details.php';
require get_template_directory() . '/page-templates/frontpage-feature.php';


/************************ Edge Widgets  *****************************/
require get_template_directory() . '/inc/widgets/widgets-functions/contactus-widgets.php';
require get_template_directory() . '/inc/widgets/widgets-functions/register-widgets.php';

/************************ Edge Customizer  *****************************/
require get_template_directory() . '/inc/customizer/functions/sanitize-functions.php';
require get_template_directory() . '/inc/customizer/functions/register-panel.php';
function edge_customize_register( $wp_customize ) {
if(!class_exists('Edge_Plus_Features')){
	class Edge_Customize_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
			<a title="<?php esc_html_e( 'Review Edge', 'edge' ); ?>" href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/edge/' ); ?>" target="_blank" id="about_edge">
			<?php esc_html_e( 'Review Edge', 'edge' ); ?>
			</a><br/>
			<a href="<?php echo esc_url( 'https://themefreesia.com/theme-instruction/edge/' ); ?>" title="<?php esc_html_e( 'Theme Instructions', 'edge' ); ?>" target="_blank" id="about_edge">
			<?php esc_html_e( 'Theme Instructions', 'edge' ); ?>
			</a><br/>
			<a href="<?php echo esc_url( 'https://themefreesia.com/support-forum/' ); ?>" title="<?php esc_html_e( 'Forum', 'edge' ); ?>" target="_blank" id="about_edge">
			<?php esc_html_e( 'Forum', 'edge' ); ?>
			</a><br/>
		<?php
		}
	}
	$wp_customize->add_section('edge_upgrade_links', array(
		'title'					=> __('About Edge', 'edge'),
		'priority'				=> 2,
	));
	$wp_customize->add_setting( 'edge_upgrade_links', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control(
		new Edge_Customize_upgrade(
		$wp_customize,
		'edge_upgrade_links',
			array(
				'section'				=> 'edge_upgrade_links',
				'settings'				=> 'edge_upgrade_links',
			)
		)
	);
}	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'edge_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'edge_customize_partial_blogdescription',
		) );
	}
	require get_template_directory() . '/inc/customizer/functions/frontpage-features.php';
	require get_template_directory() . '/inc/customizer/functions/design-options.php';
	require get_template_directory() . '/inc/customizer/functions/theme-options.php';
	require get_template_directory() . '/inc/customizer/functions/social-icons.php';
	require get_template_directory() . '/inc/customizer/functions/featured-content-customizer.php' ;
	require get_template_directory() . '/inc/customizer/functions/color-options.php' ;
}
if(!class_exists('Edge_Plus_Features')){
	// Add Upgrade to Plus Button.
	require_once( trailingslashit( get_template_directory() ) . 'inc/upgrade-plus/class-customize.php' );
}
/**************************************************************************************/
	/* Color Styles */
	require get_template_directory() . '/inc/settings/color-option-functions.php' ;
/** 
* Render the site title for the selective refresh partial. 
* @see edge_customize_register() 
* @return void 
*/ 
function edge_customize_partial_blogname() { 
bloginfo( 'name' ); 
} 

/** 
* Render the site tagline for the selective refresh partial. 
* @see edge_customize_register() 
* @return void 
*/ 
function edge_customize_partial_blogdescription() { 
bloginfo( 'description' ); 
}
add_action( 'customize_register', 'edge_customize_register' );
/**************************************************************************************/
function edge_hide_previous_custom_css( $wp_customize ) { 
	// Bail if not WP 4.7. 
	if ( ! function_exists( 'wp_get_custom_css_post' ) ) { 
		return; 
	} 
		$wp_customize->remove_control( 'edge_theme_options[edge_custom_css]' ); 
} 
add_action( 'customize_register', 'edge_hide_previous_custom_css'); 

/******************* Edge Header Display *************************/
function edge_header_display(){
	$edge_settings = edge_get_theme_options();
	$header_display = $edge_settings['edge_header_display'];
	if ($header_display == 'header_text') { ?>
		<div id="site-branding">
		<?php if(is_home() || is_front_page()){ ?>
		<h1 id="site-title"> <?php }else{?> <h2 id="site-title"> <?php } ?>
			<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>
		<?php if(is_home() || is_front_page() || is_search()){ ?>
		</h1>  <!-- end .site-title -->
		<?php } else { ?> </h2> <!-- end .site-title --> <?php } 
		$site_description = get_bloginfo( 'description', 'display' );
		if($site_description){?>
		<p id ="site-description"> <?php bloginfo('description');?> </p> <!-- end #site-description -->
		<?php } ?>
		</div> <!-- end #site-branding -->
		<?php
	} elseif ($header_display == 'header_logo') { ?>
		<div id="site-branding"> <?php edge_the_custom_logo(); ?></div> <!-- end #site-branding -->
		<?php } elseif ($header_display == 'show_both'){ ?>
		<div id="site-branding"> <?php edge_the_custom_logo(); ?></a>
		<?php if(is_home() || is_front_page()){ ?>
		<h1 id="site-title"> <?php }else{?> <h2 id="site-title"> <?php } ?>
			<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>
			<?php if(is_home() || is_front_page()){ ?> </h1> <!-- end .site-title -->
		<?php }else{ ?> </h2> <!-- end .site-title -->
		<?php }
		$site_description = get_bloginfo( 'description', 'display' );
			if($site_description){?>
			<p id ="site-description"> <?php bloginfo('description');?> </p><!-- end #site-description -->
		<?php } ?>
		</div> <!-- end #site-branding -->
		<?php }
}
add_action('edge_site_branding','edge_header_display');

if ( ! function_exists( 'edge_the_custom_logo' ) ) : 
 	/** 
 	 * Displays the optional custom logo. 
 	 * Does nothing if the custom logo is not available. 
 	 */ 
 	function edge_the_custom_logo() { 
 	    if ( function_exists( 'the_custom_logo' ) ) { 
 	        the_custom_logo(); 
 	    }
 	} 
 	endif;

/* Header Image */
function edge_header_image_display(){
	$edge_header_image = get_header_image();
	if(!empty($edge_header_image)){ ?>
		<a href="<?php echo esc_url(home_url('/'));?>"><img src="<?php echo esc_url($edge_header_image);?>" class="header-image" width="<?php echo get_custom_header()->width;?>" height="<?php echo get_custom_header()->height;?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>"> </a>
	<?php }
}
add_action('edge_header_image','edge_header_image_display');
?>