<?php
/**
 * Maker Customizer Custom Controls.
 *
 * @package Maker
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Displays custom message with a call to action link.
 */
class Maker_Message_Pro_Control extends WP_Customize_Control {

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

		if ( $this->label ) {
			printf(
				'<span class="customize-control-title">%s<span class="pro-badge">Pro</span></span>',
				esc_html( $this->label )
			);
		}

		if ( $this->description ) {
			printf(
				'<p class="customize-control-paragraph">%s</p>',
				wp_kses_post( $this->description )
			);
		}

		if ( $this->url && $this->cta ) {
			printf(
				'<p class="customize-control-paragraph"><a href="%s" target="_blank" class="button button-primary">%s</a></p>',
				esc_url( $this->url ),
				esc_html( $this->cta )
			);
		}
	}
}

/**
 * Displays custom message with a call to action link.
 */
class Maker_Message_Control extends WP_Customize_Control {

	/**
	 * Render the content.
	 */
	public function render_content() {

		if ( $this->label ) {
			printf(
				'<span class="customize-control-title">%s</span>',
				esc_html( $this->label )
			);
		}

		if ( $this->description ) {
			printf(
				'<p class="customize-control-paragraph">%s</p>',
				wp_kses_post( $this->description )
			);
		}
	}
}
