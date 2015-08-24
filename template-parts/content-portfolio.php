<?php
/**
 * @package Maker
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'project' ); ?>>

	<?php maker_post_thumbnail(); ?>

	<header class="project-header">

		<?php the_title( sprintf( '<h1 class="project-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		
		<?php echo maker_get_portfolio_item_category(); ?>
		
	</header><!-- .project-header -->

</article><!-- #post-## -->