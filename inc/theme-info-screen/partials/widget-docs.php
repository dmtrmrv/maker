<?php
/**
 * Docs widget on a welcome screen.
 *
 * @package Maker
 */

?>

<div class="tp-theme-info-sidebar-widget card">
	<h2><?php esc_html_e( 'Have a question?', 'maker' ); ?></h2>
	<p><?php esc_html_e( 'Check out our easy-to-follow articles with screenshots about the theme at ThemePatio knowledge base.', 'maker' ); ?></p>
	<?php
		printf(
			'<p><a href="%s" target="_blank" class="button button-primary">%s</a></p>',
			'https://docs.themepatio.com/maker-getting-started/',
			esc_html__( 'View Docs', 'maker' )
		);
	?>
</div>
