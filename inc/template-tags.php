<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Maker
 */

if ( ! function_exists( 'maker_entry_category' ) ) :
/**
 * Displays categories.
 */
function maker_entry_category() {
	$categories_list = get_the_category_list( esc_html__( ', ', 'maker' ) );
	if ( $categories_list && maker_categorized_blog() ) {
		printf( '<div class="entry-meta-item cat-links">' . esc_html__( '%s', 'maker' ) . '</div>', $categories_list ); // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'maker_jetpack_portfolio_type' ) ) :
/**
 * Displays Jetpack portfolio type.
 */
function maker_jetpack_portfolio_type() {
	$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', ', ', '' );
	if ( $categories_list ) {
		printf( '<div class="project-categories">' . esc_html__( '%s', 'maker' ) . '</div>', $categories_list ); // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'maker_jetpack_portfolio_tag' ) ) :
/**
 * Displays Jetpack portfolio tag.
 */
function maker_jetpack_portfolio_tag() {
	$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag', '', ', ', '' );
	if ( $categories_list ) {
		printf( '<div class="project-categories">' . esc_html__( '%s', 'maker' ) . '</div>', $categories_list ); // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'maker_portfolio_toolkit_category' ) ) :
/**
 * Displays Portfolio Toolkit's portfolio category.
 */
function maker_portfolio_toolkit_category() {
	$categories_list = get_the_term_list( get_the_ID(), 'portfolio-category', '', ', ', '' );
	if ( $categories_list ) {
		printf( '<div class="project-categories">' . esc_html__( '%s', 'maker' ) . '</div>', $categories_list ); // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'maker_portfolio_toolkit_tag' ) ) :
/**
 * Displays Portfolio Toolkit's portfolio tag.
 */
function maker_portfolio_toolkit_tag() {
	$tags_list = get_the_term_list( get_the_ID(), 'portfolio-tag', '', ', ', '' );
	if ( $tags_list ) {
		printf( '<div class="project-tags">' . esc_html__( '%s', 'maker' ) . '</div>', $tags_list ); // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'maker_entry_author' ) ) :
/**
 * Displays link to all posts written by an author of the current post.
 */
function maker_entry_author() {
	printf(
		'<span class="entry-meta-item byline"><span class="author vcard"><a class="url fn n" href="%s">%s</a></span></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}
endif;

if ( ! function_exists( 'maker_entry_date' ) ) :
/**
 * Displays Date of the current post.
 */
function maker_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( '<span class="entry-meta-item posted-on"><a href="%s" rel="bookmark">%s</a></span>',  // WPCS: XSS OK.
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;

if ( ! function_exists( 'maker_entry_comments_link' ) ) :
/**
 * Prints HTML with a link to post comments.
 */
function maker_entry_comments_link() {
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		if ( intval( get_comments_number() ) == 0 ) {
			return;
		}

		echo '<span class="entry-meta-item comments-link">';
			comments_popup_link(
				__( 'Leave a comment', 'maker' ),
				__( 'One Comment', 'maker' ),
				__( '% Comments', 'maker' )
			);
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'maker_entry_meta_before_content' ) ) :
/**
 * Prints HTML with meta information for the current post.
 */
function maker_entry_meta_before_content() {
	// Only display meta on posts.
	if ( 'post' == get_post_type() ) {

		echo '<div class="entry-meta">';

		maker_entry_category();

		maker_entry_author();

		maker_entry_date();

		maker_entry_comments_link();

		edit_post_link( __( 'Edit', 'maker' ), '<span class="entry-meta-item edit-link">', '</span>' );

		echo '</div>';
	}
}
endif;

if ( ! function_exists( 'maker_portfolio_toolkit_meta' ) ) :
/**
 * Prints project meta for Portfolio Toolkit posts.
 */
function maker_portfolio_toolkit_meta() {

	// Return if we don't need to display meta.
	if ( ! get_theme_mod( 'maker_display_project_meta', 1 ) ) {
		return;
	}

	$client     = get_post_meta( get_the_ID(), '_portfolio_toolkit_project_client', true );
	$date       = get_post_meta( get_the_ID(), '_portfolio_toolkit_project_date',   true );
	$url        = get_post_meta( get_the_ID(), '_portfolio_toolkit_project_url',    true );
	$categories = get_the_term_list( get_the_ID(), 'portfolio-category', '', ', ', '' );
	$tags       = get_the_term_list( get_the_ID(), 'portfolio-tag',      '', ', ', '' );

	if ( $client || $date || $url || $categories || $tags ) :

		echo '<div class="project-meta"><table>';

		// Client.
		if ( $client ) :
		printf(
			'<tr><td class="project-meta-item-name">%s</td><td class="project-meta-item-desc">%s</td></tr>',
			esc_html__( 'Client', 'maker' ),
			esc_html( $client )
		);
		endif;

		// Date.
		if ( $date ) :
		printf(
			'<tr><td class="project-meta-item-name">%s</td><td class="project-meta-item-desc">%s</td></tr>',
			esc_html__( 'Date', 'maker' ),
			esc_html( $date )
		);
		endif;

		// URL.
		if ( $url ) :
		$parsed = parse_url( $url );
		$domain = preg_replace( '/^www\./', '', $parsed['host'] );
		printf(
			'<tr><td class="project-meta-item-name">%s</td><td class="project-meta-item-desc">%s</td></tr>',
			esc_html__( 'Link', 'maker' ),
			'<a href="' . esc_url( $url ) . '">' . esc_html( $domain )
		);
		endif;

		// Category.
		if ( $categories ) :
		printf( // WPCS: XSS OK.
			'<tr><td class="project-meta-item-name">%s</td><td class="project-meta-item-desc project-meta-cats">%s</td></tr>',
			esc_html__( 'Category', 'maker' ),
			sprintf( esc_html__( '%s', 'maker' ), $categories )
		);
		endif;

		// Tag.
		if ( $tags ) :
		printf( // WPCS: XSS OK.
			'<tr><td class="project-meta-item-name">%s</td><td class="project-meta-item-desc project-meta-tags">%s</td></tr>',
			esc_html__( 'Tags', 'maker' ),
			sprintf( esc_html__( '%s', 'maker' ), $tags )
		);
		endif;

	echo '</table></div>';

	endif;
}
endif;

if ( ! function_exists( 'maker_portfolio_jetpack_meta' ) ) :
/**
 * Prints project meta for Jetpack portfolio posts.
 */
function maker_portfolio_jetpack_meta() {

	// Return if we don't need to display meta.
	if ( ! get_theme_mod( 'maker_display_project_meta', 1 ) ) {
		return;
	}

	$categories = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', ', ', '' );
	$tags       = get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag',  '', ', ', '' );

	if ( $categories || $tags ) :

		echo '<div class="project-meta"><table>';

		// Category.
		if ( $categories ) :
		printf( // WPCS: XSS OK.
			'<tr><td class="project-meta-item-name">%s</td><td class="project-meta-item-desc project-meta-cats">%s</td></tr>',
			esc_html__( 'Category', 'maker' ),
			sprintf( esc_html__( '%s', 'maker' ), $categories )
		);
		endif;

		// Tag.
		if ( $tags ) :
		printf( // WPCS: XSS OK.
			'<tr><td class="project-meta-item-name">%s</td><td class="project-meta-item-desc project-meta-tags">%s</td></tr>',
			esc_html__( 'Tags', 'maker' ),
			sprintf( esc_html__( '%s', 'maker' ), $tags )
		);
		endif;

	echo '</table></div>';

	endif;
}
endif;

if ( ! function_exists( 'maker_entry_meta_after_content' ) ) :
/**
 * Prints HTML with meta after page content.
 */
function maker_entry_meta_after_content() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		$tags_list = get_the_tag_list( '', esc_html__( '', 'maker' ) );
		if ( $tags_list ) {
			printf( '<footer class="entry-footer"><span class="tags-links">' . esc_html__( '%1$s', 'maker' ) . '</span></footer><!-- .entry-footer -->', $tags_list ); // WPCS: XSS OK.
		}
	} elseif ( 'page' == get_post_type() && current_user_can( 'edit_pages' ) ) {
		echo '<footer class="entry-footer">';
			edit_post_link( __( 'Edit', 'maker' ), '<span class="edit-link">', '</span>' );
		echo '</footer><!-- .entry-footer -->';
	}
}
endif;

if ( ! function_exists( 'maker_site_title' ) ) :
/**
 * Displays site title.
 */
function maker_site_title() {
	$class = 'site-title';
	if ( false == get_theme_mod( 'maker_display_title', true ) ) {
		$class .= ' screen-reader-text';
	}
	printf( '<h1 class="%s"><a href="%s" rel="home">%s</a></h1>',
		esc_attr( $class ),
		esc_url( home_url( '/' ) ),
		esc_html( get_bloginfo( 'name' ) )
	);
}
endif;

if ( ! function_exists( 'maker_site_description' ) ) :
/**
 * Displays site description.
 */
function maker_site_description() {
	$class = 'site-description';
	if ( false == get_theme_mod( 'maker_display_tagline', true ) ) {
		$class .= ' screen-reader-text';
	}
	printf( '<h2 class="%s">%s</h2>', esc_attr( $class ), esc_html( get_bloginfo( 'description' ) ) );
}
endif;

if ( ! function_exists( 'maker_site_logo' ) ) :
/**
 * Displays site logo.
 */
function maker_site_logo() {
	if ( ! get_theme_mod( 'maker_logo' ) ) {
		return;
	} else {
		printf( '<a href="%1$s" class="site-logo-link" rel="home"><img src="%2$s" alt="%3$s"></a>',
			esc_url( home_url( '/' ) ),
			esc_url( get_theme_mod( 'maker_logo' ) ),
			esc_attr( get_bloginfo( 'name', 'display' ) )
		);
	}
}
endif;

if ( ! function_exists( 'maker_post_thumbnail' ) ) :
/**
 * Displays post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * view, or a div element on single view.
 */
function maker_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( 'jetpack-portfolio' == get_post_type() || 'portfolio' == get_post_type() ) {
		printf( '<a class="project-thumbnail" href="%s">', esc_url( apply_filters( 'the_permalink', get_permalink() ) ) );
			the_post_thumbnail( 'maker-thumbnail-portfolio' );
		echo '</a>';
	} elseif ( is_singular() ) {
		echo '<div class="post-thumbnail">';
			if ( is_active_sidebar( 'sidebar-1' ) ) {
				the_post_thumbnail( 'maker-thumbnail' );
			} else {
				the_post_thumbnail( 'maker-thumbnail-fullwidth' );
			}
		echo '</div>';
	} else {
		printf( '<a class="post-thumbnail" href="%s">', esc_url( apply_filters( 'the_permalink', get_permalink() ) ) );
			if ( is_active_sidebar( 'sidebar-1' ) ) {
				the_post_thumbnail( 'maker-thumbnail' );
			} else {
				the_post_thumbnail( 'maker-thumbnail-fullwidth' );
			}
		echo '</a>';
	}
}
endif;

if ( ! function_exists( 'maker_portfolio_grid_class' ) ) :
	/**
	 * Defines portfolio grid class depending on number of columns.
	 */
	function maker_portfolio_grid_class() {
		$maker_portfolio_grid_class = 'portfolio-grid-col-3';

		if ( get_theme_mod( 'maker_portfolio_columns' ) ) {
			switch ( get_theme_mod( 'maker_portfolio_columns' ) ) {
				case 2:
					$maker_portfolio_grid_class = 'portfolio-grid-col-2';
					break;
				case 4:
					$maker_portfolio_grid_class = 'portfolio-grid-col-4';
					break;
				default:
					$maker_portfolio_grid_class = 'portfolio-grid-col-3';
					break;
			}
		}

		return $maker_portfolio_grid_class;
	}
endif;

if ( ! function_exists( 'maker_manual_excerpt' ) ) :
/**
 * Displays excerpt set manually.
 */
function maker_manual_excerpt() {
	global $post;
	if ( $post->post_excerpt ) {
		echo '<p>' . wp_kses_post( $post->post_excerpt ) . '</p>';
	}
}
endif;

if ( ! function_exists( 'maker_posts_pagination' ) ) :
/**
 * Displays Posts Navigation a.k.a Older/Newer posts links on a blog/archive page.
 */
function maker_posts_pagination() {
	$args = array(
		'prev_text'          => __( 'Newer', 'maker' ),
		'next_text'          => __( 'Older', 'maker' ),
		'screen_reader_text' => __( 'Posts navigation', 'maker' ),
	);
	the_posts_pagination( $args );
}
endif;

if ( ! function_exists( 'maker_post_navigation' ) ) :
/**
 * Displays Post Navigation a.k.a Next/Previous Post links on a single post page.
 */
function maker_post_navigation() {
	$args = array(
		'prev_text'          => '%title',
		'next_text'          => '%title',
		'screen_reader_text' => __( 'Post navigation', 'maker' ),
	);

		$previous = get_previous_post_link( '<div class="nav-previous"><span>' . esc_html__( 'Older:', 'maker' ) . ' </span>%link</div>', $args['prev_text'] );
		$next     = get_next_post_link( '<div class="nav-next"><span>' . esc_html__( 'Newer:', 'maker' ) . ' </span>%link</div>', $args['next_text'] );

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		echo _navigation_markup( $next . $previous, 'post-navigation', $args['screen_reader_text'] ); // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'maker_portfolio_navigation' ) ) :
/**
 * Displays Post Navigation a.k.a Next/Prev Post links on a single post page.
 */
function maker_portfolio_navigation() {
	$prev = '';
	$next = '';

	// Get URLs of a previous and next portfolio items.
	$prev_url = get_permalink( get_adjacent_post( false, '', false ) );
	$next_url = get_permalink( get_adjacent_post( false, '', true ) );
	$all_url  = get_post_type_archive_link( get_post_type() );

	if ( get_permalink() != $prev_url ) {
		$prev = sprintf(
			'<a href="%s" class="prev page-numbers">%s</a>',
			esc_url( $prev_url ),
			esc_html__( 'Prev', 'maker' )
		);
	}

	if ( get_permalink() != $next_url ) {
		$next = sprintf(
			'<a href="%s" class="next page-numbers">%s</a>',
			esc_url( $next_url ),
			esc_html__( 'Next', 'maker' )
		);
	}

	// Override link to all projects, if it was set in the customizer.
	if ( get_theme_mod( 'maker_all_projects_link' ) ) {
		$all_url = get_theme_mod( 'maker_all_projects_link' );
	}

	$all  = sprintf(
		'<a href="%s" class="all page-numbers"><span>%s</span></a>',
		esc_url( $all_url ),
		esc_html__( 'All Projects', 'maker' )
	);

	// Only add markup if there's somewhere to navigate to.
	if ( $prev || $next ) {
		echo _navigation_markup( $prev . $all . $next, 'pagination', __( 'Portfolio navigation', 'maker' ) ); // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'maker_comment_navigation' ) ) :
/**
 * Displays Comment Navigation.
 */
function maker_comment_navigation() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'maker' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'maker' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'maker' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
	<?php endif;
}
endif;

if ( ! function_exists( 'maker_footer_text' ) ) :
/**
 * Displays Footer Text.
 */
function maker_footer_text() {
	printf(
		esc_html__( '%1$s theme by %2$s', 'maker' ),
		'Maker',
		'<a href="' . esc_url( 'https://themepatio.com/' ) . '">ThemePatio</a>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function maker_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'maker_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'maker_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so maker_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so maker_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in maker_categorized_blog.
 */
function maker_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'maker_categories' );
}
add_action( 'edit_category', 'maker_category_transient_flusher' );
add_action( 'save_post',     'maker_category_transient_flusher' );
