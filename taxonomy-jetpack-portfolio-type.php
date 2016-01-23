<?php
/**
 * The template for displaying Jetpack portfolio type.
 *
 * @package Maker
 */

get_header(); ?>

<div id="main" class="site-main" role="main">
	<div id="content" class="site-content">
		<?php printf( '<div id="primary" class="portfolio-grid %s">', sanitize_html_class( maker_portfolio_grid_class() ) ); ?>

			<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->
					
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'portfolio-jetpack' ); ?>

					<?php endwhile; ?>

				<?php maker_posts_pagination(); ?>
					
			<?php endif; ?>
		</div>
	</div><!-- #content -->
</div><!-- #main -->

<?php get_footer(); ?>
