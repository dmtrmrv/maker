<?php
/**
 * Maker Pro Tab on a welcome screen.
 *
 * @package Maker.
 */

?>

<div id="pro" class="tab-content tp-pro-tab card">

<h2 class="tab-heading">Maker Pro</h2>

<div class="tp-media-container" style="margin-top: 0;">
	<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/theme-info-screen/img/tp-theme-pro-01.png' ); ?>">
</div>

<div class="tp-two-col">
	<div class="tp-col">
		<h3><?php esc_html_e( 'Unlimited Color Schemes', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'With Maker Pro, you can easily change the look of your website by adjusting the color scheme. You can change the text color, link color, site and background colors.', 'maker' ); ?></p>
	</div>
	<div class="tp-col">
		<h3><?php esc_html_e( 'Custom Background Image', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'Maker Pro supports the native WordPress Custom Background feature. Simply upload the image to the media library and set it as your website background in the Customizer.', 'maker' ); ?></p>
	</div>
</div>

<div class="tp-two-col">
	<div class="tp-col">
		<h3><?php esc_html_e( 'Custom Layouts', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'Don\'t like the three column grid on the front page? With Maker Pro, you can set it to two or four columns right from the Customizer.', 'maker' ); ?></p>
	</div>
	<div class="tp-col">
		<h3><?php esc_html_e( 'Archive Page Template', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'Maker Pro also has a very handy archive page template that displays ten latest posts, archives by month, year and subject.', 'maker' ); ?></p>
	</div>
</div>

<div class="tp-two-col">
	<div class="tp-col">
		<h3><?php esc_html_e( 'Custom Footer Text', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'With Maker Pro, you can set your own footer text. You may optionally use the [year] shortcode to display current year.', 'maker' ); ?></p>
	</div>
	<div class="tp-col">
		<h3><?php esc_html_e( 'XML Demo Data', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'Maker Pro also comes packed with the demo data, so you can import it and start editing to get the idea of how the theme works.', 'maker' ); ?></p>
	</div>
</div>
<?php if ( ! $this->maker_is_pro() ) : ?>
	<div class="tp-well">
		<div class="tp-well-message"><?php esc_html_e( 'Maker Pro also comes with a year of updates and our friendly support. Level up!', 'maker' ); ?></div>
		<p>
			<?php
				printf(
					'<a href="%s" class="button button-hero button-primary">%s</a>',
					esc_url( $this->theme_url . '#tp-child-theme' ),
					esc_html__( 'Purchase Maker Pro', 'maker' )
				);
			?>
		</p>
	</div>
<?php endif; ?>

</div>
