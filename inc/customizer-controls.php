<?php
/**
 * Maker Theme Customizer Custom Controls
 *
 * @package Maker
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Displays custom message with a call to action link.
 */
class Maker_Message_Custom_Control extends WP_Customize_Control {

	/**
	 * CTA url
	 *
	 * @var string
	 */
	public $url = '';

	/**
	 * CTA message
	 *
	 * @var string
	 */
	public $cta = '';

	/**
	 * Render the content.
	 */
	public function render_content() {

		if ( isset( $this->label ) ) {
			printf(
				'<span class="customize-control-title">%s<span class="pro-badge">Pro</span></span>',
				esc_html( $this->label )
			);
		}

		if ( isset( $this->description ) ) {
			printf(
				'<span class="description customize-control-description">%s</span>',
				wp_kses_post( $this->description )
			);
		}

		if ( isset( $this->url ) && isset( $this->cta ) ) {
			printf(
				'<span><a href="%s">%s</a></span>',
				esc_url( $this->url ),
				esc_html( $this->cta )
			);
		}

	}
}
