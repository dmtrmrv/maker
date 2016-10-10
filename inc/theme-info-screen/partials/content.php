<?php
/**
 * Intro Tab on a welcome screen.
 *
 * @package Maker.
 */

?>

<div class="tp-theme-info-content card">
	<h1 id="tp-theme-info-title"><?php esc_html_e( 'Getting Started', 'maker' ); ?></h1>
	<div id="tp-theme-info-text">
		<p>
			<em id="tp-theme-info-loading"><?php esc_html_e( 'Loading', 'maker' ); ?></em>
			<em id="tp-theme-info-error" style="display: none;"><?php esc_html_e( 'Something went wrong! Please contact support.', 'maker' ); ?></em>
		</p>
	</div>
</div>
