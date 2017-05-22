<?php
/**
 * Custom functions
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */
/********************* Set Default Value if not set ***********************************/
	if ( !get_theme_mod('edge_theme_options') ) {
		set_theme_mod( 'edge_theme_options', edge_get_option_defaults_values() );
	}
/********************* EDGE RESPONSIVE AND CUSTOM CSS OPTIONS ***********************************/
function edge_resp_and_custom_css() {
	$edge_settings = edge_get_theme_options();
	if( $edge_settings['edge_responsive'] == 'on' ) { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php } else{ ?>
	<meta name="viewport" content="width=1070" />
	<?php  }
	if (($edge_settings['edge_slider_content_bg_color']=='on' ) || ($edge_settings['edge_disable_big_letter']=='off')){
		$edge_internal_css = '<!-- Custom CSS -->'."\n";
		$edge_internal_css .= '<style type="text/css" media="screen">'."\n";
		if($edge_settings['edge_slider_content_bg_color']=='on'){
			$edge_internal_css .= '/*Slider Content With background color*/
									.slider-content {
										background: rgba(255, 255, 255, 0.5);
										border: 10px double rgba(255, 255, 255, 0.5);
										padding: 20px 30px 30px;
									}'."\n";
		}
		if($edge_settings['edge_disable_big_letter']=='off'){
			$edge_internal_css .= '/*Disabled First Big Letter */
									.post:first-child .entry-content p:first-child:first-letter {
									 border-right: none;
									 display: inherit;
									 float: inherit;
									 font-family: inherit;
									 font-size: inherit;
									 line-height: inherit;
									 margin-bottom: inherit;
									 margin-right: inherit;
									 margin-top: inherit;
									 padding: inherit;
									 text-a'."\n";
		}
		$edge_internal_css .= '</style>'."\n";
	}

	if (isset($edge_internal_css)) {
		echo $edge_internal_css;
	}
}
add_filter( 'wp_head', 'edge_resp_and_custom_css');

/******************************** EXCERPT LENGTH *********************************/
function edge_excerpt_length($length) {
	$edge_settings = edge_get_theme_options();
	$edge_excerpt_length = $edge_settings['edge_excerpt_length'];
	return absint($edge_excerpt_length);// this will return 30 words in the excerpt
}
add_filter('excerpt_length', 'edge_excerpt_length');

/********************* CONTINUE READING LINKS FOR EXCERPT *********************************/
function edge_continue_reading() {
	 return '&hellip; '; 
}
add_filter('excerpt_more', 'edge_continue_reading');

/***************** USED CLASS FOR BODY TAGS ******************************/
function edge_body_class($classes) {
	$edge_settings = edge_get_theme_options();
	$edge_site_layout = $edge_settings['edge_design_layout'];
	$edge_blog_layout = $edge_settings['edge_blog_layout'];

	if (is_page_template('page-templates/page-template-contact.php')) {
			$classes[] = 'contact';
	}
	if ($edge_site_layout =='boxed-layout') {
		$classes[] = 'boxed-layout';
	}
	if ($edge_site_layout =='small-boxed-layout') {
		$classes[] = 'boxed-layout-small';
	}
	if ($edge_blog_layout =='medium_image_display') {
		$classes[] = 'small_image_blog';
	}elseif($edge_blog_layout =='single_column_blog'){
		$classes[] = 'single_column_blog';
	}
	return $classes;
}
add_filter('body_class', 'edge_body_class');

/***************************************************/
function edge_customize_scripts() {

	// Load the html5 shiv.
	wp_enqueue_script( 'edge-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'edge-html5', 'conditional', 'lt IE 9' );
}
add_action( 'customize_controls_print_scripts', 'edge_customize_scripts');

/**************************** SOCIAL MENU *********************************************/
function edge_social_links() { ?>
	<div class="social-links clearfix">
		<?php
		$edge_settings = edge_get_theme_options();
		if( !empty($edge_settings['edge_social_facebook']) ):
			echo '<a target="_blank" href="'.esc_url($edge_settings['edge_social_facebook']).'"><i class="fa fa-facebook"></i></a>';
		endif;
		if( !empty($edge_settings['edge_social_twitter']) ):
			echo '<a target="_blank" href="'.esc_url($edge_settings['edge_social_twitter']).'"><i class="fa fa-twitter"></i></a>';
		endif;
		if( !empty($edge_settings['edge_social_pinterest']) ):
			echo '<a target="_blank" href="'.esc_url($edge_settings['edge_social_pinterest']).'"><i class="fa fa-pinterest-p"></i></a>';
		endif;
		if( !empty($edge_settings['edge_social_dribbble']) ):
			echo '<a target="_blank" href="'.esc_url($edge_settings['edge_social_dribbble']).'"><i class="fa fa-dribbble"></i></a>';
		endif;
		if( !empty($edge_settings['edge_social_instagram']) ):
			echo '<a target="_blank" href="'.esc_url($edge_settings['edge_social_instagram']).'"><i class="fa fa-instagram"></i></a>';
		endif;
		if( !empty($edge_settings['edge_social_flickr']) ):
			echo '<a target="_blank" href="'.esc_url($edge_settings['edge_social_flickr']).'"><i class="fa fa-flickr"></i></a>';
		endif;
		if( !empty($edge_settings['edge_social_googleplus']) ):
			echo '<a target="_blank" href="'.esc_url($edge_settings['edge_social_googleplus']).'"><i class="fa fa-google-plus-official"></i></a>';
		endif;
		if( !empty($edge_settings['edge_social_linkedin']) ):
			echo '<a target="_blank" href="'.esc_url($edge_settings['edge_social_linkedin']).'"><i class="fa fa-linkedin"></i></a>';
		endif;
		if(class_exists('Edge_Plus_Features')){
			do_action ('social_Plus_links');
		}
			?>
	</div><!-- end .social-links -->
<?php }
add_action ('social_links', 'edge_social_links');

/******************* DISPLAY BREADCRUMBS ******************************/
function edge_breadcrumb() {
	if (function_exists('bcn_display')) { ?>
		<div class="breadcrumb home">
			<?php bcn_display(); ?>
		</div> <!-- .breadcrumb -->
	<?php }
}

/*********************** edge PAGE SLIDERS ***********************************/
function edge_page_sliders() {
	$edge_settings = edge_get_theme_options();
	$excerpt = get_the_excerpt();
	$slider_custom_text = $edge_settings['edge_secondary_text'];
	$slider_custom_url = $edge_settings['edge_secondary_url'];
	global $edge_excerpt_length;
	global $post;
	$edge_page_sliders_display = '';
	$edge_total_page_no 		= 0; 
	$edge_list_page				= array();
	for( $i = 1; $i <= $edge_settings['edge_slider_no']; $i++ ){
		if( isset ( $edge_settings['edge_featured_page_slider_' . $i] ) && $edge_settings['edge_featured_page_slider_' . $i] > 0 ){
			$edge_total_page_no++;
			$edge_list_page	=	array_merge( $edge_list_page, array( esc_attr($edge_settings['edge_featured_page_slider_' . $i] )) );
		}
	}
		if ( !empty( $edge_list_page ) && $edge_total_page_no > 0 ) {
			$edge_page_sliders_display 	.= '<div class="main-slider clearfix"> <div class="layer-slider">';
					$get_featured_posts 		= new WP_Query(array( 'posts_per_page'=> $edge_settings['edge_slider_no'], 'post_type' => array('page'), 'post__in' => $edge_list_page, 'orderby' => 'post__in', ));
					$i=0;
			while ($get_featured_posts->have_posts()):$get_featured_posts->the_post();
			$attachment_id = get_post_thumbnail_id();
			$image_attributes = wp_get_attachment_image_src($attachment_id,'edge_slider_image');
						$i++;
						$title_attribute       	 	 = apply_filters('the_title', get_the_title($post->ID));
						$excerpt               	 	 = substr(get_the_excerpt(), 0 , 160);
						if (1 == $i) {$classes   	 = "slides show-display";} else { $classes = "slides hide-display";}
				$edge_page_sliders_display    	.= '<div class="'.$classes.'">';
				if ($image_attributes) {
					$edge_page_sliders_display 	.= '<div class="image-slider clearfix" title="'.the_title('', '', false).'"' .' style="background-image:url(' ."'" .esc_url($image_attributes[0])."'" .')">';
				}
				if ($title_attribute != '' || $excerpt != '') {
						$edge_page_sliders_display 	.= '<article class="slider-content clearfix">';
				
				$remove_link = $edge_settings['edge_slider_link'];
					if($remove_link == 0){
						if ($title_attribute != '') {
							$edge_page_sliders_display .= '<h2 class="slider-title"><a href="'.get_permalink().'" title="'.the_title('', '', false).'" rel="bookmark">'.get_the_title().'</a></h2><!-- .slider-title -->';
						}
					}else{
						$edge_page_sliders_display .= '<h2 class="slider-title">'.get_the_title().'</h2><!-- .slider-title -->';
					}
					if ($excerpt != '') {
						$excerpt_text = $edge_settings['edge_tag_text'];
						$edge_page_sliders_display .= '<div class="slider-text">';
						$edge_page_sliders_display .= '<h3>'.esc_attr($excerpt).' </h3></div><!-- end .slider-text -->';
					}
					$edge_page_sliders_display .= '<div class="slider-buttons">';
					if($edge_settings['edge_slider_button'] == 0){
						if($excerpt_text == '' || $excerpt_text == 'Read More') :
							$edge_page_sliders_display 	.= '<a title='.'"'.get_the_title(). '"'. ' '.'href="'.get_permalink().'"'.' class="btn-default">'.__('Read More', 'edge').'</a>';
						else:
						$edge_page_sliders_display 	.= '<a title='.'"'.get_the_title(). '"'. ' '.'href="'.get_permalink().'"'.' class="btn-default">'.$edge_settings[ 'edge_tag_text' ].'</a>';
						endif;
							}
						if(!empty($slider_custom_text)){
						$edge_page_sliders_display 	.= '<a title="'.esc_attr($slider_custom_text).'"' .' href="'.esc_url($slider_custom_url). '"'. ' class="btn-default" target="_blank">'.esc_attr($slider_custom_text). '</a>';
					}
					$edge_page_sliders_display 	.='</div><!-- end .slider-buttons -->';
					$edge_page_sliders_display 	.='</article><!-- end .slider-content --> ';
				}
				if ($image_attributes) {
					$edge_page_sliders_display 	.='</div><!-- end .image-slider -->';
				}
				$edge_page_sliders_display 	.='</div><!-- end .slides -->';
			endwhile;
			wp_reset_postdata();
			$edge_page_sliders_display .= '</div>	  <!-- end .layer-slider -->
					<a class="slider-prev" id="prev2" href="#"><i class="fa fa-angle-left"></i></a> <a class="slider-next" id="next2" href="#"><i class="fa fa-angle-right"></i></a>
  					<nav class="slider-button"> </nav> <!-- end .slider-button -->
				</div> <!-- end .main-slider -->';
		}
				echo $edge_page_sliders_display;
}



/*************************** ENQUEING STYLES AND SCRIPTS ****************************************/
function edge_scripts() {
	$edge_settings = edge_get_theme_options();
	wp_enqueue_style( 'edge-style', get_stylesheet_uri() );
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css');
	wp_enqueue_script('jquery_cycle_all', get_template_directory_uri().'/js/jquery.cycle.all.js', array('jquery'), false, true);
	wp_enqueue_script('edge_slider', get_template_directory_uri().'/js/edge-slider-setting.js', array('jquery_cycle_all'), false, true);
	wp_enqueue_script('edge-main', get_template_directory_uri().'/js/edge-main.js', array('jquery'), false, true);
	$edge_stick_menu = $edge_settings['edge_stick_menu'];
	if($edge_stick_menu != 1):
		wp_enqueue_script('jquery_sticky', get_template_directory_uri().'/assets/sticky/jquery.sticky.min.js', array('jquery'), false, true);
	wp_enqueue_script('sticky_settings', get_template_directory_uri().'/assets/sticky/sticky-settings.js', array('jquery'), false, true);
	endif;
	
	wp_style_add_data('edge-ie', 'conditional', 'lt IE 9');
	if( $edge_settings['edge_responsive'] == 'on' ) {
		wp_enqueue_style('edge-responsive', get_template_directory_uri().'/css/responsive.css');
	}

	/********* Adding Multiple Fonts ********************/
	$edge_googlefont = array();
	array_push( $edge_googlefont, 'Lato:400,300,700,400italic');
	array_push( $edge_googlefont, 'Playfair+Display');
	$edge_googlefonts = implode("|", $edge_googlefont);
	wp_register_style( 'edge_google_fonts', '//fonts.googleapis.com/css?family='.$edge_googlefonts);
	wp_enqueue_style( 'edge_google_fonts' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'edge_scripts' );/*************************** Importing Custom CSS to the core option added in WordPress 4.7. ****************************************/
function edge_custom_css_migrate(){
$ver = get_theme_mod( 'custom_css_version', false );
	if ( version_compare( $ver, '4.7' ) >= 0 ) {
		return;
	}
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		$edge_settings = edge_get_theme_options();
		if ( $edge_settings['edge_custom_css'] != '' ) {
			$edge_core_css = wp_get_custom_css(); // Preserve css which is added from core
			$return   = wp_update_custom_css_post( $edge_core_css . $edge_settings['edge_custom_css'] );
			if ( ! is_wp_error( $return ) ) {
				unset( $edge_settings['edge_custom_css'] );
				set_theme_mod( 'edge_theme_options', $edge_settings );
				set_theme_mod( 'custom_css_version', '4.7' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'edge_custom_css_migrate' );
?>