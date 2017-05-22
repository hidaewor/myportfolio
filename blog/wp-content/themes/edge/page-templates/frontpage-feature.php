<?php
function edge_frontpage_features(){
	$edge_settings = edge_get_theme_options();
	if($edge_settings['edge_disable_features'] != 1){
		$edge_features = '';
		$edge_total_page_no = 0; 
		$edge_list_page	= array();
		for( $i = 1; $i <= $edge_settings['edge_total_features']; $i++ ){
			if( isset ( $edge_settings['edge_frontpage_features_' . $i] ) && $edge_settings['edge_frontpage_features_' . $i] > 0 ){
				$edge_total_page_no++;

				$edge_list_page	=	array_merge( $edge_list_page, array( $edge_settings['edge_frontpage_features_' . $i] ) );
			}

		}
		if ( !empty( $edge_list_page ) && $edge_total_page_no > 0 ) {
			echo '<!-- Promotional Area ============================================= -->';
				$edge_features 	.= '<div class="promonational-area">';
								$get_featured_posts 		= new WP_Query(array(
								'posts_per_page'      	=> $edge_settings['edge_total_features'],
								'post_type'           	=> array('page'),
								'post__in'            	=> $edge_list_page,
								'orderby'             	=> 'post__in',
							));
					$edge_features .= '<div class="column clearfix">';
				$j = 1;
				while ($get_featured_posts->have_posts()):$get_featured_posts->the_post();
				$attachment_id = get_post_thumbnail_id();
				$image_attributes = wp_get_attachment_image_src($attachment_id,'pixgraphy_promotional_image');
							$excerpt               	 	 = get_the_excerpt();
					$edge_features .= '<div class="three-column">';
					if ($image_attributes) {
						$edge_features 	.= '<div class="promonational-img" title="'.the_title('', '', false).'"' .' style="background-image:url(' ."'" .esc_url($image_attributes[0])."'" .')"> <a class="promonational-link" href="'.get_the_permalink().'"></a>	';
						$edge_features .= '<div class="promonational-overlay">
								<h4>'.get_the_title().'</h4></div></div>';
					}
					$edge_features 	.='</div><!-- end .three-column -->';
					$j++;
					endwhile;
					$edge_features 	.='</div><!-- .end column-->';
					$edge_features 	.='</div><!-- end .promonational-area -->';
				}
		echo $edge_features;
	}
		wp_reset_postdata();
}
add_action('edge_display_frontpage_features','edge_frontpage_features');
?>