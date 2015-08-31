<?php
/**
 * The template used for displaying portfolio item content in portfolio-jetpack.php
 *
 * @package Maker
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'project' ); ?>>

	<?php maker_post_thumbnail(); ?>

	<header class="project-header">

		<?php the_title( sprintf( '<h1 class="project-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		
		<?php maker_jetpack_portfolio_type(); ?>
		
	</header><!-- .project-header -->
	
</article><!-- #post-## -->
