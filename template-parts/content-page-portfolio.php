<?php
/**
 * The template used for displaying a project on a portfolio grid page.
 *
 * @package Maker
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( ! get_theme_mod( 'portfolio_display_page_content', false ) ? 'screen-reader-text portfolio-grid-content' : 'portfolio-grid-content' ); ?>>

	<?php maker_post_thumbnail(); ?>

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>

		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'maker' ), 'after' => '</div>' ) ); ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
