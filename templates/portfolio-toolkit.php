<?php
/**
 * The template for displaying portfolio by Portfolio Toolkit.
 *
 * Template Name: Portfolio – Portfolio Toolkit
 *
 * @package Maker
 */

get_header(); ?>

<div id="main" class="site-main" role="main">
	<div id="content" class="site-content">
		<div id="primary" class="content-area">

			<?php
				// Content before the portfolio grid.
				if ( get_theme_mod( 'maker_display_portfolio_text', 1 ) ) {
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'page' );
					endwhile;
				}

				// Portfolio grid. Check if we have pagination first.
				if ( get_query_var( 'paged' ) ) :
					$paged = get_query_var( 'paged' );
				elseif ( get_query_var( 'page' ) ) :
					$paged = get_query_var( 'page' );
				else :
					$paged = 1;
				endif;

				// Default posts per page option.
				$posts_per_page = get_option( 'posts_per_page', 9 );

				// Check if Portfolio Toolkit is activated.
				if ( post_type_exists( 'portfolio' ) ) :

					$args = array(
						'post_type'      => 'portfolio',
						'paged'          => $paged,
						'posts_per_page' => $posts_per_page,
					);

					$portfolio_query = new WP_Query( $args );

					// Pagination fix.
					$temp_query = $wp_query;
					$wp_query   = null;
					$wp_query   = $portfolio_query;

					if ( $portfolio_query -> have_posts() ) :

						printf(
							'<div class="portfolio-grid %s">',
							sanitize_html_class( maker_portfolio_grid_class() )
						);

						while ( $portfolio_query -> have_posts() ) : $portfolio_query -> the_post();

							get_template_part( 'template-parts/content', 'portfolio-toolkit' );

						endwhile;

						echo '</div>';

						wp_reset_postdata();

						maker_posts_pagination();

					endif;

					// Restore original query.
					$wp_query = null;
					$wp_query = $temp_query;

				endif;
			?>

		</div>
	</div><!-- #content -->
</div><!-- #main -->

<?php get_footer(); ?>
