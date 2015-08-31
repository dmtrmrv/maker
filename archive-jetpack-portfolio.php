<?php
/**
 * The template for displaying archive projects by Jetpack Portfolio.
 *
 * @package Maker
 */

get_header(); ?>

<div id="main" class="site-main" role="main">
	<div id="content" class="site-content">
		<div id="primary" class="portfolio-grid">

			<?php if ( have_posts() ) : ?>
					
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'portfolio' ); ?>

					<?php endwhile; ?>

				<?php maker_paging_nav(); ?>
					
			<?php endif; ?>
		</div>
	</div><!-- #content -->
</div><!-- #main -->

<?php get_footer(); ?>
