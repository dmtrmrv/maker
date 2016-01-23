<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Maker
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One Comment', '%s Comments', get_comments_number(), 'Comments title', 'maker' ) ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h3>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => '96',
				) );
			?>
		</ul><!-- .comment-list -->

		<?php maker_comment_navigation(); ?>

	<?php endif; ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			printf(
				'<p class="no-comments">%s</p>',
				esc_html_e( 'Comments are closed.', 'maker' )
			);
		}

		// Display comment form.
		comment_form( array(
			'title_reply_to'    => __( 'Reply to %s', 'maker' ),
			'cancel_reply_link' => __( 'Cancel', 'maker' ),
		) );
	?>

</div><!-- #comments -->
