<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Maker
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function maker_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'primary',
		'render'    => 'maker_infinite_scroll_render',
		'type'      => 'click'
	) );

	add_filter( 'infinite_scroll_js_settings', 'maker_load_more_text' );
}
add_action( 'after_setup_theme', 'maker_jetpack_setup' );

function maker_infinite_scroll_render() {
	while ( have_posts() ) : the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content-search' );
		elseif ( 'portfolio' == get_post_type() ) :
			get_template_part( 'template-parts/content', 'portfolio' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	endwhile;
}

function maker_load_more_text( $settings ) {
	$settings['text'] = __( 'Load More', 'maker' );

	return $settings;
}