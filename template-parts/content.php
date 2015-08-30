<?php
/**
 * The default template used for displaying post content in index.php
 *
 * @package Maker
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php maker_post_thumbnail(); ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<?php maker_entry_meta_before_content(); ?>

	<div class="entry-content">
		<?php the_content( sprintf( __( 'Continue reading %s', 'maker' ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) ); ?>
		
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'maker' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
