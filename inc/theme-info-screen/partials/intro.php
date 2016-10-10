<?php
/**
 * Theme info screen intro.
 *
 * @package Maker
 */

?>

<div class="tp-theme-intro">
	<div class="tp-theme-screenshot">
		<img src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/screenshot.png'; ?>" alt="<?php echo esc_html( $this->theme->get( 'Name' ) ); ?>" />
	</div>

	<div class="tp-theme-description">
		<?php
			// Title and version.
			printf(
				'<h1 class="tp-theme-description-name">%s <span class="tp-theme-description-version">%s</span></h1>',
				esc_html( $this->theme->get( 'Name' ) ),
				esc_html__( 'Version: ', 'maker' ) . esc_html( $this->theme->get( 'Version' ) )
			);

			// Theme description.
			printf(
				'<p class="tp-theme-description-text">%s</p>',
				esc_html( $this->theme->get( 'Description' ) )
			);
		?>
	</div>
</div><!-- .theme-intro -->
