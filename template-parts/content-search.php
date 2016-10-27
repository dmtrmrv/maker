<?php
/**
 * The template part for displaying results in search pages.
 *
 * @package Maker
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-summary">

		<?php the_excerpt(); ?>

		<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue Reading', 'maker' ); ?></a>

	</div><!-- .entry-summary -->

</article><!-- #post-## -->
