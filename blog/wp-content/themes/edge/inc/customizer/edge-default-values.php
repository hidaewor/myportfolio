<?php
if(!function_exists('edge_get_option_defaults_values')):
	/******************** EDGE DEFAULT OPTION VALUES ******************************************/
	function edge_get_option_defaults_values() {
		global $edge_default_values;
		$edge_default_values = array(
			'edge_total_features'	=> '3',
			'edge_disable_features'	=> 0,
			'edge_responsive'	=> 'on',
			'edge_disable_big_letter'	=> 'on',
			'edge_design_layout' => 'wide-layout',
			'edge_sidebar_layout_options' => 'right',
			'edge_blog_layout' => 'large_image_display',
			'edge_search_custom_header' => 0,
			'edge-img-upload-footer-image' => '',
			'edge_header_display'=> 'header_text',
			'edge_categories'	=> array(),
			'edge_custom_css'	=> '',
			'edge_scroll'	=> 0,
			'edge_tag_text' => 'Read More',
			'edge_excerpt_length'	=> '55',
			'edge_search_text' => 'Search',
			'edge_single_post_image' => 'off',
			'edge_reset_all' => 0,
			'edge_stick_menu'	=>0,
			'edge_blog_post_image' => 'on',
			'edge_entry_format_blog' => 'excerptblog_display',
			'edge_search_text' => 'Search &hellip;',
			'edge_blog_content_layout'	=> '',
			'edge_slider_button' => 0,
			'edge_tag_text' => 'Read More',
			'edge_secondary_text' => '',
			'edge_secondary_url' => '',
			'edge_slider_content_bg_color' => 'off',
			'edge_display_page_featured_image'=>0,

			/* Slider Settings */
			'edge_slider_type'	=> 'default_slider',
			'edge_slider_link' =>0,
			'edge_enable_slider' => 'frontpage',
			'edge_transition_effect' => 'fade',
			'edge_transition_delay' => '4',
			'edge_transition_duration' => '1',
			'edge_slider_no' => '4',
			'edge_footer_column_section' =>'4',
			/* Front page feature */
			'edge_entry_format_blog' => 'show',
			'edge_entry_meta_blog' => 'show-meta',
			/*Social Icons */
			'edge_top_social_icons' =>0,
			'edge_buttom_social_icons'	=>0,
			'edge_social_facebook'=> '',
			'edge_social_twitter'=> '',
			'edge_social_pinterest'=> '',
			'edge_social_dribbble'=> '',
			'edge_social_instagram'=> '',
			'edge_social_flickr'=> '',
			'edge_social_googleplus'=> '',
			'edge_social_linkedin'=>''
			);
		return apply_filters( 'edge_get_option_defaults_values', $edge_default_values );
	}
endif;
?>