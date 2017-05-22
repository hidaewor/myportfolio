<?php
/**
 * Template Name: Contact Template
 *
 * Displays the contact page template.
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */
get_header();
	global $edge_settings;
	$edge_settings = wp_parse_args(  get_option( 'edge_theme_options', array() ),  edge_get_option_defaults_values() );
		global $edge_content_layout;
	if( $post ) {
		$layout = get_post_meta( $post->ID, 'edge_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}
	if( 'default' == $layout ) { //Settings from customizer
		if(($edge_settings['edge_sidebar_layout_options'] != 'nosidebar') && ($edge_settings['edge_sidebar_layout_options'] != 'fullwidth')){ ?>

<div id="primary">
<?php }
	}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<div id="primary">
	<?php }
	}?>
	<main id="main">
	<?php
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			if('' != get_the_content()) : ?>
	<div class="googlemaps_widget">
		<div class="maps-container">
			<?php the_content(); ?>
		</div>
	</div> <!-- end .googlemaps_widget -->
	<?php endif; ?>
		<div class="entry-content clearfix">
		<?php if ( is_active_sidebar( 'edge_form_for_contact_page' ) ) :
			dynamic_sidebar( 'edge_form_for_contact_page' );
		endif; 
		comments_template();
			}
		}
		else { ?>
		<h2 class="entry-title"> <?php esc_html_e( 'No Posts Found.', 'edge' ); ?> </h2>
		<?php
		} ?>
		</div> <!-- end #entry-content -->
	</main> <!-- end #main -->
	<?php  if( 'default' == $layout ) { //Settings from customizer
	if(($edge_settings['edge_sidebar_layout_options'] != 'nosidebar') && ($edge_settings['edge_sidebar_layout_options'] != 'fullwidth')): ?>
</div> <!-- #primary -->
<?php endif;
}else{ // for page/post
	if(($layout != 'no-sidebar') && ($layout != 'full-width')){
		echo '</div><!-- #primary -->';
	} 
}?>
<?php 
if( 'default' == $layout ) { //Settings from customizer
	if(($edge_settings['edge_sidebar_layout_options'] != 'nosidebar') && ($edge_settings['edge_sidebar_layout_options'] != 'fullwidth')){ ?>
<div id="secondary">
<?php }
}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<div id="secondary">
	<?php }
	}
	if ( is_active_sidebar( 'edge_contact_page_sidebar' ) ) :
		dynamic_sidebar( 'edge_contact_page_sidebar' );
	endif;?>
	<?php 
	if( 'default' == $layout ) { //Settings from customizer
		if(($edge_settings['edge_sidebar_layout_options'] != 'nosidebar') && ($edge_settings['edge_sidebar_layout_options'] != 'fullwidth')): ?>
</div> <!-- #secondary -->
<?php endif;
	}else{ // for page/post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){
			echo '</div><!-- #secondary -->';
		} 
	}
get_footer(); ?>