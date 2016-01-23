<?php
/**
 * The template for displaying archive projects by Portfolio Toolkit.
 *
 * @package Maker
 */

get_header(); ?>

<div id="main" class="site-main" role="main">
	<div id="content" class="site-content">
		<?php printf( '<div id="primary" class="portfolio-grid %s">', sanitize_html_class( maker_portfolio_grid_class() ) ); ?>

			<?php if ( have_posts() ) : ?>
					
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'portfolio-toolkit' ); ?>

					<?php endwhile; ?>

				<?php maker_posts_pagination(); ?>
					
			<?php endif; ?>
		</div><!-- .portfolio-grid -->
	</div><!-- #content -->
</div><!-- #main -->

<?php get_footer(); ?>
