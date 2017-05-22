<?php
/**
 * Custom functions
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */

/****************** EDGE DISPLAY COMMENT NAVIGATION *******************************/
function edge_comment_nav() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'edge' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'edge' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;
				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'edge' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
/******************** Remove div and replace with ul**************************************/
add_filter('wp_page_menu', 'edge_wp_page_menu');
function edge_wp_page_menu($page_markup) {
	preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
	$divclass   = $matches[1];
	$replace    = array('<div class="'.$divclass.'">', '</div>');
	$new_markup = str_replace($replace, '', $page_markup);
	$new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
	return $new_markup;
}
/***************Pass slider effect  parameters from php files to jquery file ********************/
function edge_slider_value() {
	$edge_settings = edge_get_theme_options();
	$edge_transition_effect   = esc_attr($edge_settings['edge_transition_effect']);
	$edge_transition_delay    = absint($edge_settings['edge_transition_delay'])*1000;
	$edge_transition_duration = absint($edge_settings['edge_transition_duration'])*1000;
	wp_localize_script(
		'edge_slider',
		'edge_slider_value',
		array(
			'transition_effect'   => $edge_transition_effect,
			'transition_delay'    => $edge_transition_delay,
			'transition_duration' => $edge_transition_duration,
		)
	);
}
/**************************** Display Header Title ***********************************/
function edge_header_title() {
	$format = get_post_format();
	$edge_settings = edge_get_theme_options();
	$edge_header_title='';
	if( is_archive() ) {
		if ( is_category() ) :
			$edge_header_title = single_cat_title( '', FALSE );
		elseif ( is_tag() ) :
			if($edge_settings['edge_blog_layout'] != 'photography_layout' ):
				$edge_header_title = single_tag_title( '', FALSE );
			endif;
		elseif ( is_author() ) :
			the_post();
			$edge_header_title =  sprintf( __( 'Author: %s', 'edge' ), '<span class="vcard">' . get_the_author() . '</span>' );
			rewind_posts();
		elseif ( is_day() ) :
			$edge_header_title = sprintf( __( 'Day: %s', 'edge' ), '<span>' . get_the_date() . '</span>' );
		elseif ( is_month() ) :
			$edge_header_title = sprintf( __( 'Month: %s', 'edge' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
		elseif ( is_year() ) :
			$edge_header_title = sprintf( __( 'Year: %s', 'edge' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
		elseif ( $format == 'audio' ) :
			$edge_header_title = __( 'Audios', 'edge' );
		elseif ( $format =='aside' ) :
			$edge_header_title = __( 'Asides', 'edge');
		elseif ( $format =='image' ) :
			$edge_header_title = __( 'Images', 'edge' );
		elseif ( $format =='gallery' ) :
			$edge_header_title = __( 'Galleries', 'edge' );
		elseif ( $format =='video' ) :
			$edge_header_title = __( 'Videos', 'edge' );
		elseif ( $format =='status' ) :
			$edge_header_title = __( 'Status', 'edge' );
		elseif ( $format =='quote' ) :
			$edge_header_title = __( 'Quotes', 'edge' );
		elseif ( $format =='link' ) :
			$edge_header_title = __( 'links', 'edge' );
		elseif ( $format =='chat' ) :
			$edge_header_title = __( 'Chats', 'edge' );
		elseif ( class_exists('WooCommerce') && (is_shop() || is_product_category()) ):
  			$edge_header_title = woocommerce_page_title( false );
  		elseif ( class_exists('bbPress') && is_bbpress()) :
  			$edge_header_title = get_the_title();
		else :
			$edge_header_title = __( 'Archives', 'edge' );
		endif;
	} elseif (is_home()){
		$edge_header_title = get_the_title( get_option( 'page_for_posts' ) );
	} elseif (is_404()) {
		$edge_header_title = __('Page NOT Found', 'edge');
	} elseif (is_search()) {
		$edge_header_title = __('Search Results', 'edge');
	} elseif (is_page_template()) {
		$edge_header_title = get_the_title();
	} else {
		$edge_header_title = get_the_title();
	}
	return $edge_header_title;
}
/********************* Custom Header setup ************************************/
function edge_custom_header_setup() {
	$args = array(
		'default-text-color'     => '',
		'default-image'          => '',
		'height'                 => apply_filters( 'edge_header_image_height', 400 ),
		'width'                  => apply_filters( 'edge_header_image_width', 2500 ),
		'random-default'         => false,
		'max-width'              => 2500,
		'flex-height'            => true,
		'flex-width'             => true,
		'random-default'         => false,
		'header-text'				 => false,
		'uploads'				 => true,
		'wp-head-callback'       => '',
		'admin-preview-callback' => 'edge_admin_header_image',
		'default-image' => '',
	);
	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'edge_custom_header_setup' );

/****************** Footer Menu *************************/
function edge_footer_menu_section(){
	if(has_nav_menu('footermenu')):
		$args = array(
			'theme_location' => 'footermenu',
			'container'      => '',
			'items_wrap'     => '<ul>%3$s</ul>',
		);
		echo '<nav id="footer-navigation">';
		wp_nav_menu($args);
		echo '</nav><!-- end #footer-navigation -->';
	endif;
}
add_action( 'edge_footer_menu', 'edge_footer_menu_section' );
?>