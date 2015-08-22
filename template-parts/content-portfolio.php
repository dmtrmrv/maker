<?php
/**
 * @package Maker
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'project' ); ?>>

	<?php maker_post_thumbnail(); ?>

	<header class="project-header">
		<?php the_title( sprintf( '<h1 class="project-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '<div class="project-categories">', ', ', '</div>' ); ?>
	</header><!-- .project-header -->

</article><!-- #post-## -->