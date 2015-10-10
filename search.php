<?php
/**
 * The template for displaying search results pages.
 *
 * @package Maker
 */

get_header(); ?>

<div id="main" class="site-main" role="main">
	<div id="content" class="site-content">
		<div id="primary" class="content-area">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'maker' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php get_search_form(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'search' ); ?>

			<?php endwhile; ?>

			<?php maker_posts_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</div>

		<?php get_sidebar(); ?>

	</div><!-- #content -->
</div><!-- #main -->

<?php get_footer(); ?>
