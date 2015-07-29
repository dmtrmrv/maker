<?php
/**
 * Maker Theme Customizer
 *
 * @package Maker
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function maker_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	// $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Change section title from 'Site Title & Tagline' to 'Header'.
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Header', 'maker' );

	// Logo.
	$wp_customize->add_setting( 'maker_logo', array( 
		'sanitize_callback' => 'maker_sanitize_image'
	) );

	$wp_customize -> add_control(
		new WP_Customize_Image_Control (
			$wp_customize,
			'maker_logo',
			array(
				'label'   => __( 'Logo', 'maker' ),
				'section' => 'title_tagline'
			)
		)
	);

	// Display Title.
	$wp_customize->add_setting( 'maker_display_title', array( 
		'default' => true,
		'sanitize_callback' => 'maker_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'maker_display_title', array( 
		'label'   => __( 'Display Title', 'maker' ),
		'section' => 'title_tagline',
		'type'    => 'checkbox',
	) );

	// Display Tagline.
	$wp_customize->add_setting( 'maker_display_tagline', array( 
		'default' => true,
		'sanitize_callback' => 'maker_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'maker_display_tagline', array( 
		'label'   => __( 'Display Tagline', 'maker' ),
		'section' => 'title_tagline',
		'type'    => 'checkbox',
	) );

	// Accent Color.
	$wp_customize->add_setting( 'maker_accent_color', array(
		'default'           => '#3498db',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	// Footer Text.
	$wp_customize->add_section( 'maker_footer' , array(
		'title'    => __( 'Footer', 'maker' ),
		'priority' => 130,
	) );

	$wp_customize->add_setting( 'maker_footer_text', array(
		'default'           => '',
		'sanitize_callback' => 'maker_sanitize_text',
	) );

	$wp_customize->add_control(
		new Textarea_Custom_Control(
			$wp_customize,
			'maker_footer_text',
			array(
				'label'       => __( 'Footer Text', 'maker' ),
				'section'     => 'maker_footer',
				'type'        => 'text',
				'description' => __( 'You may use [year] shortcode to display current year.', 'maker' ),
			)
		)
	);

	$wp_customize -> add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'maker_accent_color',
			array(
				'label'   => __( 'Accent Color', 'maker' ),
				'section' => 'colors'
			)
		)
	);
}
add_action( 'customize_register', 'maker_customize_register' );

/**
 * Sanitizes Text.
 */
function maker_sanitize_text( $input ) {
	global $allowedtags;
	return wp_kses( $input , $allowedtags );
}

/**
 * Sanitizes Checkbox.
 */
function maker_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return 0;
	}
}

/**
 * Sanitizes Image Upload.
 */
function maker_sanitize_image( $input ) {
	$output = '';

	$filetype = wp_check_filetype( $input );
	if ( $filetype["ext"] && wp_ext2type( $filetype["ext"] ) === 'image' ) {
		$output = esc_url( $input );
	}

	return $output;
}

/**
 * Outputs custom styles to the header.
 */
function maker_custom_style_header_output() {
	// Don't print any styles if no color, or if it is set to default.
	$color = get_theme_mod( 'maker_accent_color' );
	if ( ! $color || $color == '#3498db' ) {
		return;
	}

	// Build and print styles.
	$style = "";
	$style .= "a,";
	$style .= ".entry-meta-item.cat-links a,";
	$style .= ".entry-meta-item a:hover,";
	$style .= ".entry-meta-item a:focus,";
	$style .= ".widget a:hover,";
	$style .= ".widget a:focus,";
	$style .= ".tags-links a:hover,";
	$style .= ".tags-links a:focus";
	$style .= "{ color: $color }";
	$style .= ".comment-form .submit,";
	$style .= "input[type='submit'].wpcf7-submit { background-color: $color; border-color: $color; }";
	
	echo '<style type="text/css">' . $style . '</style>';
}
add_action( 'wp_head' ,'maker_custom_style_header_output' );

/**
 * Binds js handlers to make theme customizer preview reload changes asynchronously.
 */
function maker_customize_preview_js() {
	wp_enqueue_script( 'maker_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'maker_customize_preview_js' );