<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Maker
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="search-results-item-header">
		<?php the_title( sprintf( '<h1 class="search-results-item-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="search-results-item-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
</article><!-- #post-## -->
