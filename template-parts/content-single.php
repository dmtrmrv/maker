<?php
/**
 * The template used for displaying post content in single.php
 *
 * @package Maker
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php maker_post_thumbnail(); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php maker_entry_meta_before_content(); ?>

	<div class="entry-content post-single-item-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'maker' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php maker_entry_meta_after_content(); ?>
	
</article><!-- #post-## -->
