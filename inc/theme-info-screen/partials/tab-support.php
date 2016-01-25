<?php
/**
 * Support Tab on a welcome screen.
 *
 * @package Maker.
 */

?>

<div id="support" class="tab-content card">

<h2 class="tab-heading"><?php esc_html_e( 'Support', 'maker' ); ?></h2>

<h3><?php esc_html_e( 'Basic Support (Free with Maker Pro)', 'maker' ); ?></h3>

<p><?php esc_html_e( 'Basic support is included with the Purchase of Maker Pro. It includes answering the setup questions, questions about how the theme works and fixing bugs. Support lasts for one year after a theme purchase.', 'maker' ); ?></p>

<p class="tp-theme-feature-buttons">
	<?php
	if ( ! $this->maker_is_pro() ) {
		// Purchase Maker Pro Button.
		printf(
			'<a href="%s" class="button button-primary">%s</a>',
			esc_url( $this->theme_url . '#tp-child-theme' ),
			esc_html__( 'Purchase Maker Pro', 'maker' )
		);
	} else {
		// Submit a Ticket Button.
		printf(
			'<a href="%s" class="button button-primary">%s</a> ',
			esc_url( $this->theme_author_url . 'support' ),
			esc_html__( 'Submit a Ticket', 'maker' )
		);
	}
	?>
</p>

<hr>

<h3><?php esc_html_e( 'Priority Support $59', 'maker' ); ?></h3>

<p><?php esc_html_e( 'Priority support is a huge time-saver. On top of the basic plan, it includes answers to the more technical questions, faster responses, and theme and demo data installation. Priority Support can be provided for our free themes as well. It lasts for 45 days from the day of purchase.', 'maker' ); ?></p>

<p class="tp-theme-feature-buttons">
	<?php
		// Details button.
		printf(
			'<a href="%s" class="button">%s</a> ',
			esc_url( $this->theme_author_url . 'support' ),
			esc_html__( 'Details', 'maker' )
		);

		// Purchase Premium Support Button.
		printf(
			'<a href="%s" class="button button-primary">%s</a> ',
			esc_url( $this->theme_author_url . 'support' ),
			esc_html__( 'Purchase Priority Support', 'maker' )
		);
	?>
</p>

<hr>

<h3><?php esc_html_e( 'Free Support', 'maker' ); ?></h3>

<p><?php esc_html_e( 'Please be advised that, even though, Maker is free, we can not guarantee free support for it. Consider purchasing Maker Pro or Priority Support plan to get access to our friendly one-on-one dedicated support!', 'maker' ); ?></p>

<p><?php esc_html_e( 'We do however encourage you to tell us if something went wrong through support forum. We do our best to provide timely support there but do not guarantee it.', 'maker' ); ?></p>

</div>
