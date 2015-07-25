<?php
/**
 * @package Maker
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php maker_entry_meta_header(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php maker_post_thumbnail(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'maker' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php maker_entry_meta_footer(); ?>
	
</article><!-- #post-## -->
