<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Primer
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php primer_post_thumbnail(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'primer' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php primer_entry_meta_footer(); ?>

</article><!-- #post-## -->
