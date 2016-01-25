<?php
/**
 * Intro Tab on a welcome screen.
 *
 * @package Maker.
 */

?>

<div id="features" class="tab-content tab-features card">

<h2 class="tab-heading"><?php esc_html_e( 'Theme Features', 'maker' ); ?></h2>

<div class="tp-two-col">
	<div class="tp-col">
		<div class="tp-media-container" style="margin-top: 0;">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/theme-info-screen/img/tp-theme-feature-01.png' ); ?>">
		</div>
	</div>
	<div class="tp-col">
		<h3 class="tp-col-heading" style="margin-top: 0;"><?php esc_html_e( 'Responsive Layout', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'Maker is built to work great on any device and with any screen resolution. From a small phone to a large desktop computer.', 'maker' ); ?></p>
	</div>
</div>

<hr>

<div class="tp-two-col">
	<div class="tp-col">
		<div class="tp-media-container">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/theme-info-screen/img/tp-theme-feature-02.png' ); ?>">
		</div>
	</div>
	<div class="tp-col">
		<h3 class="tp-col-heading"><?php esc_html_e( 'Easy-to-manage Portfolio', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'With a free Portfolio Toolkit plugin, you can easily add a portfolio functionality to your website. Simply install and activate it and you are ready to go. You can also install Maker also supports Jetpack Portfolio Custom Content Types.', 'maker' ); ?></p>
	</div>
</div>

<hr>

<div class="tp-two-col">
	<div class="tp-col">
		<div class="tp-media-container">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/theme-info-screen/img/tp-theme-feature-03.png' ); ?>">
		</div>
	</div>
	<div class="tp-col">
		<h3 class="tp-col-heading"><?php esc_html_e( 'Solid Foundation', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'Maker is built with Underscores, the community-approved platform that serves as a foundation for default themes like Twenty Sixteen. Maker follows WordPress coding standards and passes the same codesniffer tests as Underscores.', 'maker' ); ?></p>
	</div>
</div>

<hr>

<div class="tp-two-col">
	<div class="tp-col">
		<div class="tp-media-container">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/theme-info-screen/img/tp-theme-feature-04.png' ); ?>">
		</div>
	</div>
	<div class="tp-col">
		<h3 class="tp-col-heading"><?php esc_html_e( 'Social Icons', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'Maker has a very useful feature of showing the social icons next to the menu items. Simply call the menu "Social" and provide the links to your social profiles. The Icons will appear automagically.', 'maker' ); ?></p>
	</div>
</div>

<hr>

<div class="tp-two-col">
	<div class="tp-col">
		<div class="tp-media-container">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/theme-info-screen/img/tp-theme-feature-05.png' ); ?>">
		</div>
	</div>
	<div class="tp-col">
		<h3 class="tp-col-heading"><?php esc_html_e( 'Footer Message (Pro)', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'With Maker Pro, you can change the default footer message. There is also a very neat feature that allows you to display the current year. Simply insert a [year] shortcode and forget about updating the footer each year.', 'maker' ); ?></p>
		<?php
			if ( ! $this->maker_is_pro() ) {
				printf(
					'<p><a href="%s" class="button button-primary">%s</a></p>',
					esc_url( $this->theme_url . '#tp-child-theme' ),
					esc_html__( 'Purchase Maker Pro', 'maker' )
				);
			}
		?>
	</div>
</div>

<hr>

<div class="tp-two-col">
	<div class="tp-col">
		<div class="tp-media-container">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/theme-info-screen/img/tp-theme-feature-06.png' ); ?>">
		</div>
	</div>
	<div class="tp-col">
		<h3 class="tp-col-heading"><?php esc_html_e( 'Unlimited Colors (Pro)', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'With Maker Pro you can easily change the look of your website by adjusting the color scheme. You can change the text color, link color, site and background colors.', 'maker' ); ?></p>
		<?php
			if ( ! $this->maker_is_pro() ) {
				printf(
					'<p><a href="%s" class="button button-primary">%s</a></p>',
					esc_url( $this->theme_url . '#tp-child-theme' ),
					esc_html__( 'Purchase Maker Pro', 'maker' )
				);
			}
		?>
	</div>
</div>

<hr>

<div class="tp-two-col">
	<div class="tp-col">
		<div class="tp-media-container">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/theme-info-screen/img/tp-theme-feature-07.gif' ); ?>">
		</div>
	</div>
	<div class="tp-col">
		<h3 class="tp-col-heading"><?php esc_html_e( 'Custom Pages (Pro)', 'maker' ); ?></h3>
		<p><?php esc_html_e( 'Maker Pro also has a useful feature that allows you to change the number of columns on the portfolio grid page. You can choose from 2, 3 or 4 columns.', 'maker' ); ?></p>
		<?php
			if ( ! $this->maker_is_pro() ) {
				printf(
					'<p><a href="%s" class="button button-primary">%s</a></p>',
					esc_url( $this->theme_url . '#tp-child-theme' ),
					esc_html__( 'Purchase Maker Pro', 'maker' )
				);
			}
		?>
	</div>
</div>

</div>
