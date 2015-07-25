<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Maker
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'maker' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'maker' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'maker' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'maker' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'maker_entry_meta_header' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function maker_entry_meta_header() {
	/**
	 * Category. Hidden from page.
	 */
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'maker' ) );
		if ( $categories_list && maker_categorized_blog() ) {
			printf( '<span class="cat-links">%s</span>', $categories_list );
		}
	}

	/**
	 * Time. 
	 */
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

	printf( '<span class="posted-on"><a href="%1$s" rel="bookmark">%2$s</a></span>', esc_url( get_permalink() ), $time_string );

	/**
	 * Author.
	 */
	echo '<span class="byline">';
		printf(
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
	echo '</span>';

	/**
	 * Comments.
	 */
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'maker' ), __( '1 Comment', 'maker' ), __( '% Comments', 'maker' ) );
		echo '</span>';
	}

	/**
	 * Edit Link.
	 */
	edit_post_link( __( 'Edit', 'maker' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'maker_entry_meta_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function maker_entry_meta_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', '' );
		if ( $tags_list ) {
			echo '<footer class="entry-footer">';
				echo '<span class="tags-links">' . $tags_list . '</span>';
			echo '</footer><!-- .entry-footer -->';
		}
	} elseif ( 'page' == get_post_type() && current_user_can( 'edit_pages' ) ) {
		echo '<footer class="entry-footer">';
			edit_post_link( __( 'Edit', 'maker' ), '<span class="edit-link">', '</span>' );
		echo '</footer><!-- .entry-footer -->';
	}
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'maker' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'maker' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'maker' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'maker' ), get_the_date( _x( 'Y', 'yearly archives date format', 'maker' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'maker' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'maker' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'maker' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'maker' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'maker' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'maker' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'maker' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'maker' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'maker' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'maker' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'maker' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'maker' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'maker' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'maker' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'maker' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'maker' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
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
		$class,
		esc_url( home_url( '/' ) ),
		get_bloginfo( 'name' )
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
	printf( '<h2 class="%s">%s</h2>', $class, get_bloginfo( 'description' ) );
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

	if ( is_singular() ) {
		echo '<div class="post-thumbnail">';
			the_post_thumbnail( 'maker-thumbnail' );
		echo '</div>';
	} else {
		printf( '<a class="post-thumbnail" href="%s">', esc_url( apply_filters( 'the_permalink', get_permalink() ) ) );
			the_post_thumbnail( 'maker-thumbnail' );
		echo '</a>';	
	}
}
endif;

if ( ! function_exists( 'maker_posts_navigation' ) ) :
/**
 * Displays Posts Navigation a.k.a  Older/Newer posts links on a blog page.
 */
function maker_posts_navigation() {
	$args = array(
		'prev_text'          => __( 'Older', 'maker' ),
		'next_text'          => __( 'Newer', 'maker' ),
		'screen_reader_text' => __( 'Posts navigation', 'maker' ),
	);
	the_posts_navigation( $args );
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

	$navigation = '';
	$previous   = get_previous_post_link( '<div class="nav-previous"><span>' . __( 'Previous Post:', 'maker' ) . ' </span>%link</div>', $args['prev_text'] );
	$next       = get_next_post_link( '<div class="nav-next"><span>' . __( 'Next Post:', 'maker' ) . ' </span>%link</div>', $args['next_text'] );

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		$navigation = _navigation_markup( $next . $previous, 'post-navigation', $args['screen_reader_text'] );
	}

	echo $navigation;
}
endif;

if ( ! function_exists( 'maker_comment_navigation' ) ) :
/**
 * Displays Comment Navigation.
 */
function maker_comment_navigation( $id = '' ) {
	// Are there comments to navigate to?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
		
		// How many comments pages?
		$pages = get_comment_pages_count();
		
		// What comments page we are on?
		$page = get_query_var( 'cpage' );
		if ( !$page )
			$page = 1;
		
		// Is there an ID for the navigation block?
		if ( $id )
			$id = 'id="' . $id . '"';
		?>

		<nav <?php echo $id; ?> class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'maker' ); ?></h2>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( __( 'Previous', 'maker' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next', 'maker' ) ); ?></div>
				<div class="nav-pages"><?php printf( __( "Page %s of %s", 'maker' ), $page, $pages ) ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above --><?php 
	}
}
endif;

if ( ! function_exists( 'maker_comment_display' ) ) :
/**
 * Custom comment display.
 *
 * Displays default comments, pingbacks and trackbacks.
 * Compared to default output, this function adds translatable
 * "Post Author" string to comments written by post author,
 * and removes "says:" string after commenter's name.
 */
function maker_comment_display( $comment, $args, $depth  ) {
	$GLOBALS['comment'] = $comment;
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
	switch( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
			<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<div class="comment-body">
					<?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'maker' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			<?php break;
		default:
			$by_post_author = '';

			if( $comment->comment_author_email == get_the_author_meta('email') ) {
				$by_post_author = '<span> ' . __( 'Post Author', 'maker' ) . '</span>';
			}

			?>
			<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
					<footer class="comment-meta">
						<div class="comment-author vcard">
							<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
							<?php printf( '<span class="author-name"><b class="fn">%s</b>%s</span>', get_comment_author_link(), $by_post_author ); ?>
						</div><!-- .comment-author -->

						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'maker' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
							<?php edit_comment_link( __( 'Edit', 'maker' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .comment-metadata -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'maker' ); ?></p>
						<?php endif; ?>
					</footer><!-- .comment-meta -->

					<div class="comment-content">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>'
					) ) );
					?>
				</article><!-- .comment-body -->
			<?php
		break;
	endswitch;
}
endif;

if ( ! function_exists( 'maker_footer_text' ) ) :
/**
 * Displays Footer Text.
 */
function maker_footer_text() {
	$text = get_theme_mod( 'maker_footer_text' );
	if ( $text ) {
		echo str_replace( '[year]', date('Y'), $text );
	} else {
		printf(
			__( '%1$s theme by %2$s', 'maker' ),
			'Maker',
			'<a href="' . esc_url(  'http://themepatio.com/' ) . '">ThemePatio</a>'
		);
	}
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