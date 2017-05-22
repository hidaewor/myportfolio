<?php
/**
 * The template for displaying search results.
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */
get_header();
	$edge_settings = edge_get_theme_options();
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
		}?>
		<main id="main" class="site-main clearfix">
			<?php
			if( have_posts() ) {
				while( have_posts() ) {
					the_post(); ?>
				<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<figure class="post-featured-image">
					<a href="<?php the_permalink();?>" title="<?php echo the_title_attribute('echo=0'); ?>">
					<?php the_post_thumbnail(); ?>
					</a>
				</figure><!-- end.post-featured-image  -->
					<article class="post-format">
						<header class="entry-header">
							<h2 class="entry-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
							<?php the_title(); ?> </a> </h2> <!-- .entry-title -->
						</header>
						<div class="entry-content clearfix">
							<?php the_excerpt(); ?>
						</div>
					</article>
				</section>
				<?php }
			} else { ?>
			<h2 class="entry-title">
				<?php get_search_form(); ?>
				<p>&nbsp; </p>
				<?php esc_html_e( 'No Posts Found.', 'edge' ); ?>
			</h2>
			<?php } ?>
		</main> <!-- #main -->
		<?php get_template_part( 'pagination', 'none' );
		if( 'default' == $layout ) { //Settings from customizer
			if(($edge_settings['edge_sidebar_layout_options'] != 'nosidebar') && ($edge_settings['edge_sidebar_layout_options'] != 'fullwidth')): ?>
		</div> <!-- #primary -->
	<?php endif;
	}
get_sidebar();
get_footer(); ?>