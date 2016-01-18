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

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function maker_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'maker' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'maker_wp_title', 10, 2 );

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
 * Removes p tags from images.
 *
 * @param  string $content Post content.
 */
function maker_filter_p_tags_on_images( $content ) {
	return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}
add_filter( 'the_content', 'maker_filter_p_tags_on_images' );

/**
 * Adds an admin notice upon successful activation.
 */
function maker_activation_admin_notice() {
	global $pagenow;

	if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
		add_action( 'admin_notices', 'maker_welcome_admin_notice', 99 );
	}
}
add_action( 'load-themes.php', 'maker_activation_admin_notice' );

/**
 * Display an admin notice linking to the welcome screen.
 */
function maker_welcome_admin_notice() {
	?>
		<div class="updated notice is-dismissible">
			<p><?php echo sprintf( esc_html__( 'Thanks for choosing Maker! Visit the %sGetting Started%s page to kickstart your site with the new theme!', 'maker' ), '<a href="' . esc_url( admin_url( 'themes.php?page=maker-getting-started' ) ) . '">', '</a>' ); ?></p>
		</div>
	<?php
}
