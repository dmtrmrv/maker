<?php
/**
 * Theme info screen intro.
 *
 * @package Maker
 */

?>

<div class="tp-theme-intro">
<div class="tp-two-col">
	<div class="tp-col tp-theme-screenshot">
		<img src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/screenshot.png'; ?>" alt="Maker" />
	</div>
	
	<div class="tp-col tp-theme-description">
		<?php
			// Title and version.
			printf(
				'<h1>%s <sup><small>%s</small></sup></h1>',
				esc_html( $this->theme->get( 'Name' ) ),
				esc_html( $this->theme->get( 'Version' ) )
			);

			// Theme description.
			printf(
				'<p>%s</p>',
				esc_html( $this->theme->get( 'Description' ) )
			);
		?>

		<p></p>

	</div>
</div>
</div><!-- .theme-intro -->
