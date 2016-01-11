<?php
/**
 * Theme info screen intro.
 *
 * @package Maker
 */

$maker_theme_object = wp_get_theme( 'maker' );
?>

<div class="theme-info">
<div class="feature-section two-col">
	<div class="col theme-screenshot">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" alt="Maker" />
	</div>
	
	<div class="col">
		<?php
			// Title and version.
			printf(
				'<h1>%s <sup><small>%s</small></sup></h1>',
				esc_html( $maker_theme_object['Name'] ),
				esc_html( $maker_theme_object['Version'] )
			);

			// Theme description.
			printf(
				'<p>%s</p>',
				esc_html( $maker_theme_object['Description'] )
			);
		?>

		<p></p>

	</div>
</div>
</div><!-- .theme-intro -->
