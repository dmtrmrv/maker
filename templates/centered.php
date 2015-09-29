<?php
/**
 * The template for displaying centered pages.
 *
 * Template Name: Centered
 *
 * @package Maker
 */

get_header(); ?>

<div id="main" class="site-main" role="main">
	<div id="content" class="site-content">
		<div id="primary" class="content-area">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; ?>
			
		</div>
	</div><!-- #content -->
</div><!-- #main -->

<?php get_footer(); ?>
