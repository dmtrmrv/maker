<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Primer
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function primer_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'primary',
		'render'    => 'primer_infinite_scroll_render',
		'type'      => 'click'
	) );
}
add_action( 'after_setup_theme', 'primer_jetpack_setup' );

function primer_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
}