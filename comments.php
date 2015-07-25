<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Primer
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

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf(
					_nx( 'One Comment', '%s Comments', get_comments_number(), 'Comments title', 'primer' ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h3>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'callback'    => 'primer_comment_display',
					'short_ping'  => true,
					'avatar_size' => '96'
				) );
			?>
		</ul><!-- .comment-list -->

		<?php primer_comment_navigation( 'comment-nav-below' ); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'primer' ); ?></p>
	<?php endif; ?>

	<?php comment_form( array( 
		'title_reply'          => __( 'Leave a Comment', 'primer' ),
		'title_reply_to'       => __( 'Reply to %s', 'primer' ),
		'cancel_reply_link'    => __( 'Cancel', 'primer' ),
		'label_submit'         => __( 'Submit Comment', 'primer' ),
	) ); ?>

</div><!-- #comments -->
