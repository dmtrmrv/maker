<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Maker
 */

if ( ! function_exists( 'maker_entry_category' ) ):
/**
 * Displays categories.
 *
 * @param  string  $before String to output before the author name
 * @param  string  $after  String to output after the author name
 * @param  boolean $echo   Display the whole thing or just return it
 * @return string
 */
function maker_entry_category( $before = '', $after = '', $echo = true ) {
	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( __( ', ', 'maker' ) );
	
	if ( $categories_list && maker_categorized_blog() ) {
		$html = sprintf(
			'<span class="entry-meta-item cat-links">%s%s%s</span>',
			$before,
			$categories_list,
			$after
		);

		if ( true == $echo ) {
			echo $html;
		}

		return $html;
	}
}
endif;

if ( ! function_exists( 'maker_entry_author' ) ):
/**
 * Displays author.
 *
 * Displays link to all posts written by an author of the current post.
 * 
 * @param  string  $before String to output before the author name
 * @param  string  $after  String to output after the author name
 * @param  boolean $echo   Display the whole thing or just return it
 * @return string
 */
function maker_entry_author( $before = '', $after = '', $echo = true ) {
	// Build a string.
	$html =  sprintf(
		'<span class="entry-meta-item byline">%s<span class="author vcard"><a class="url fn n" href="%s">%s</a></span>%s</span>',
		$before,
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() ),
		$after
	);

	if ( true == $echo ) {
		echo $html;
	}
	
	return $html;
}
endif;

if ( ! function_exists( 'maker_entry_date' ) ) :
	/**
	 * Displays Date of the current post.
	 *
	 * @param  string  $before String to output before the author name
	 * @param  string  $after  String to output after the author name
	 * @param  boolean $echo   Display the whole thing or just return it
	 * @return string
	 */
	function maker_entry_date( $before = '', $after = '', $echo = true ) {
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

		$html = sprintf( '<span class="entry-meta-item posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a>%4$s</span>',
			$before,
			esc_url( get_permalink() ),
			$time_string,
			$after
		);

		if ( true == $echo ) {
			echo $html;
		}

		return $html;
	}
endif;

if ( ! function_exists( 'maker_entry_comments_link' ) ) : 
function maker_entry_comments_link( $before = '', $after = '' ) {
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		if ( intval( get_comments_number() ) == 0 ) {
			return;
		}
		echo '<span class="entry-meta-item comments-link">' . $before;
		comments_popup_link(
			__( 'Leave a comment', 'maker' ),
			__( 'One Comment', 'maker' ),
			__( '% Comments', 'maker' )
		);
		echo $after . '</span>';
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

		maker_entry_comments_link ();

		edit_post_link( __( 'Edit', 'maker' ), '<span class="entry-meta-item edit-link">', '</span>' );

		echo '</div>';
	}
}
endif;

if ( ! function_exists( 'maker_entry_meta_after_content' ) ) :
/**
 * Prints HTML with meta after page content.
 */
function maker_entry_meta_after_content() {
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
	$previous   = get_previous_post_link( '<div class="nav-previous"><span>' . __( 'Older:', 'maker' ) . ' </span>%link</div>', $args['prev_text'] );
	$next       = get_next_post_link( '<div class="nav-next"><span>' . __( 'Newer:', 'maker' ) . ' </span>%link</div>', $args['next_text'] );

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

if ( ! function_exists( 'maker_portfolio_navigation' ) ) :
/**
 * Displays Post Navigation a.k.a Next/Previous Post links on a single post page.
 */
function maker_portfolio_navigation() {
	$navigation = '';
	
	$prev = get_previous_post_link( '<div class="nav-previous">%link</div>', __( 'Prev', 'maker' ) );
	$next     = get_next_post_link(     '<div class="nav-next">%link</div>', __( 'Next', 'maker' ) );

	// Only add markup if there's somewhere to navigate to.
	if ( $prev || $next ) {
		$navigation = _navigation_markup($prev . $next, 'portfolio-navigation', __( 'Portfolio navigation', 'maker' ) );
	}

	echo $navigation;
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
			'<a href="' . esc_url(  'http://dmitrymayorov.com/' ) . '">Dmitry Mayorov</a>'
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

if ( ! function_exists( 'maker_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function maker_paging_nav( $max_num_pages = '' ) {
	// Get max_num_pages if not provided
	if ( '' == $max_num_pages )
		$max_num_pages = $GLOBALS['wp_query']->max_num_pages;

	// Don't print empty markup if there's only one page.
	if ( $max_num_pages < 2 ) {
		return;
	}
	?>
	
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'maker' ); ?></h2>
			<div class="nav-links">
				
				<?php if ( get_next_posts_link( '', $max_num_pages ) ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( 'Older', 'maker' ), $max_num_pages ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link( '', $max_num_pages ) ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer', 'maker' ), $max_num_pages ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'maker_portfolio_item_category' ) ) :
/**
 * Returns a portfolio category or project type.
 */
function maker_get_portfolio_item_category() {
	if ( 'jetpack-portfolio' == get_post_type() && has_term( '', 'jetpack-portfolio-type' ) ) {
		return get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<div class="project-categories">', ', ', '</div>' );
	} elseif ( 'portfolio' == get_post_type() && has_term( '', 'portfolio_category' ) ) {
		return get_the_term_list( get_the_ID(), 'portfolio_category', '<div class="project-categories">', ', ', '</div>' );
	}
}
endif;

if ( ! function_exists( 'maker_portfolio_item_tag' ) ) :
/**
 * Returns project tag.
 */
function maker_get_portfolio_item_tag() {
	if ( 'jetpack-portfolio' == get_post_type() && has_term( '', 'jetpack-portfolio-tag' ) ) {
		return get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag', '', ', ', '' );
	} elseif ( 'portfolio' == get_post_type() && has_term( '', 'portfolio_tag' ) ) {
		return get_the_term_list( get_the_ID(), 'portfolio_tag', '', ', ', '' );
	}
}
endif;

if ( ! function_exists( 'maker_project_meta' ) ) :
/**
 * Prints project meta.
 */
function maker_portfolio_meta() {

	$meta = array(
		__( 'Client',   'maker' ) => get_post_meta( get_the_ID(), '_portfolio_toolkit_project_client', true ),
		__( 'Date',     'maker' ) => get_post_meta( get_the_ID(), '_portfolio_toolkit_project_date',   true ),
		__( 'Link',     'maker' ) => get_post_meta( get_the_ID(), '_portfolio_toolkit_project_url',    true ),
		__( 'Category', 'maker' ) => maker_get_portfolio_item_category(),
		__( 'Tags',     'maker' ) => maker_get_portfolio_item_tag()
	);

	if ( array_filter( $meta ) ) :
	
	echo '<div class="project-meta">';
		echo '<table>';
		foreach ( $meta as $k => $v ) {
			if ( $k == __( 'Link', 'maker' ) && $v ){
				echo '<tr>';
					echo '<td class="project-meta-item-name">' . $k . '</td>';
					printf(
						'<td class="project-meta-item-desc"><a href="%s" alt="">%s</a></td>',
						esc_url( $v ),
						esc_html( $v )
					);
				echo '</tr>';
			} elseif ( $v ) {
				echo '<tr>';
					echo '<td class="project-meta-item-name">' . $k . '</td>';
					echo '<td class="project-meta-item-desc">' . $v . '</td>';
				echo '</tr>';
			}
		}
		echo '</table>';
	echo '</div>';

	endif;
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