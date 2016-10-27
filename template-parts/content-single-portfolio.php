<?php
/**
 * The template used for displaying portfolio item on a single portfolio page.
 *
 * Used both for Portfolio Toolkit and Jetpack
 *
 * @package Maker
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php maker_portfolio_project_excerpt(); ?>

		<?php maker_portfolio_project_meta(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>

		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'maker' ), 'after' => '</div>' ) ); ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
