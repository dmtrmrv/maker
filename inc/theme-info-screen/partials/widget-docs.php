<?php
/**
 * Docs widget on a welcome screen.
 *
 * @package Maker.
 */

?>

<div class="welcome-screen-widget card">
	<h2><?php esc_html_e( 'Looking For Help?', 'maker' ); ?></h2>
	<p><?php esc_html_e( 'We have more docs and tutorials at our website. Check them out if you need more detailed information about the theme.', 'maker' ); ?></p>
	<?php
		printf(
			'<p><a href="%s" class="button button-primary">%s</a></p>',
			'https://docs.themepatio.com/maker-getting-started/',
			esc_html__( 'View Documentation', 'maker' )
		);
	?>

</div>
