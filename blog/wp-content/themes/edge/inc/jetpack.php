<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Theme Freesia
 * @subpackage Edge
 * @since Edge 1.0
 */
/*********** EDGE ADD THEME SUPPORT FOR INFINITE SCROLL **************************/
function edge_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'edge_jetpack_setup' );
?>