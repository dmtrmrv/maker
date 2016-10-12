<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Maker
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function maker_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class if there are no widgets in a sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a no-excerpt class for portfolio pages without manual excerpts.
	if ( ! has_excerpt() || ! get_theme_mod( 'maker_display_project_excerpt', 1 ) ) {
		$classes[] = 'no-excerpt';
	}

	return $classes;
}
add_filter( 'body_class', 'maker_body_classes' );

if ( ! function_exists( 'maker_excerpt' ) ) :
/**
 * Custom excerpt.
 *
 * @param string $more current excerpt.
 */
function maker_excerpt( $more ) {
	global $post;
	return ' ...';
}
add_filter( 'excerpt_more', 'maker_excerpt' );
endif;

/**
 * Filters the_category() to output HTML5 valid rel tag.
 *
 * @param string $text markup containing list of categories.
 */
function maker_category_rel( $text ) {
	$search  = array( 'rel="category"', 'rel="category tag"' );
	$replace = 'rel="tag"';
	$text    = str_replace( $search, $replace, $text );
	return $text;
}
add_filter( 'the_category', 'maker_category_rel' );

/**
 * Update maximum srcset image width.
 *
 * @param int $max_width Maximum allowed image width.
 */
function remove_max_srcset_image_width( $max_width ) {
	return 1992;
}
add_filter( 'max_srcset_image_width', 'remove_max_srcset_image_width' );

/**
 * Adds an admin notice about version 0.3.0.
 */
if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' == $pagenow ) {
	add_action( 'admin_notices', 'maker_update_admin_notice', 99 );
}

/**
 * Displays an upgrade notice.
 */
function maker_update_admin_notice() {
	$message = sprintf(
		esc_html__( 'Some things have changed in Maker 0.3.0! %1$sRead%2$s the upgrade guide for more details.', 'maker' ),
		'<a href="' . esc_url( 'https://docs.themepatio.com/maker-upgrade-0-3-0/' ) . '" target="_blank">',
		'</a>'
	);

	printf( // WPCS: XSS OK.
		'<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
		$message
	);
}
