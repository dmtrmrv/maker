<?php
/**
 * Plugins Tab on a welcome screen.
 *
 * @package Maker.
 */

?>

<div id="plugins" class="tab-content card">

	<h2 class="tab-heading"><?php esc_html_e( 'Recommended Plugins', 'maker' ); ?></h2>

	<p><?php esc_html_e( 'Maker is built to work with the following plugins. Although they are completely optional we recommend installing, at least, Portfolio Toolkit to create a website that looks like the demo.', 'maker' ); ?></p>
	
	<h3>Portfolio Toolkit</h3>

	<p><?php esc_html_e( 'Adds portfolio functionality to your WordPress website. Maker is designed with this plugin in mind, however, it will not work if you enable Portfolio Toolkit and Jetpack Custom Content Types module. Maker supports both, but not at the same time.', 'maker' ); ?></p>
	
	<?php $this->maker_theme_info_screen_plugin_install_button( 'portfolio-toolkit', 'portfolio-toolkit/portfolio-toolkit.php', 'Portfolio_Toolkit' ); ?>

	<hr>

	<h3>Jetpack</h3>

	<p><?php esc_html_e( 'Adds WordPress.com functionality to your self-hosted WordPress site. Note that in order to use Jetpack you\'ll need WordPress.com account. You don\'t need to enable all the features of Jetpack. Maker uses Carousel and Tiled Galleries modules to display portfolio projects.', 'maker' ); ?></p>

	<?php $this->maker_theme_info_screen_plugin_install_button( 'jetpack', 'jetpack/jetpack.php', 'Jetpack' ); ?>	

	<hr>
	
	<h3>Contact Form 7</h3>

	<p><?php esc_html_e( 'Creates contact forms that can be easily added to posts, pages, and widgets.', 'maker' ); ?></p>

	<?php $this->maker_theme_info_screen_plugin_install_button( 'contact-form-7', 'contact-form-7/wp-contact-form-7.php', 'WPCF7' ); ?>

	<hr>

	<h3>Regenerate Thumbnails</h3>

	<p><?php esc_html_e( 'This plugin allows you to regenerate thumbnails for your image attachments. It may be very useful if you are switching from another theme.', 'maker' ); ?></p>

	<?php $this->maker_theme_info_screen_plugin_install_button( 'regenerate-thumbnails', 'regenerate-thumbnails/regenerate-thumbnails.php', 'RegenerateThumbnails' ); ?>

</div>
