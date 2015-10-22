<?php
/**
 * The template used for displaying portfolio item content in single-jetpack-portfolio.php
 *
 * @package Maker
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		<?php if ( has_excerpt() && get_theme_mod( 'maker_display_project_excerpt', 1 ) ) : ?>
			<div class="project-excerpt">
				<?php maker_manual_excerpt(); ?>
			</div>
		<?php endif; ?>

		<?php maker_portfolio_jetpack_meta(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'maker' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
