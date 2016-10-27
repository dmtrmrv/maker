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

	// Display site title.
	$wp_customize->add_setting( 'display_blogname', array(
		'default'           => 1,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'maker_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'display_blogname', array(
		'label'   => __( 'Display Site Title', 'maker' ),
		'section' => 'title_tagline',
		'type'    => 'checkbox',
	) );

	// Display site tagline.
	$wp_customize->add_setting( 'display_blogdescription', array(
		'default'           => 1,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'maker_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'display_blogdescription', array(
		'label'   => __( 'Display Tagline', 'maker' ),
		'section' => 'title_tagline',
		'type'    => 'checkbox',
	) );

	// Portfolio.
	$wp_customize->add_section( 'maker_portfolio' , array(
		'title'    => __( 'Portfolio', 'maker' ),
		'priority' => 130,
	) );

	$wp_customize -> add_control(
		new Maker_Message_Control(
			$wp_customize,
			'maker_portfolio',
			array(
				'label'           => __( 'Navigate to Portfolio', 'maker' ),
				'settings'        => array(),
				'description'     => __( 'To edit the portfolio, open either a single portfolio project or a portfolio grid page in the preview screen on the right.', 'maker' ),
				'section'         => 'maker_portfolio',
				'active_callback' => 'maker_not_portfolio_template',
			)
		)
	);

	$wp_customize->add_setting( 'maker_display_portfolio_text', array(
		'default'           => 1,
		'sanitize_callback' => 'maker_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'maker_display_portfolio_text', array(
		'label'           => __( 'Display Page Content', 'maker' ),
		'section'         => 'maker_portfolio',
		'type'            => 'checkbox',
		'active_callback' => 'maker_is_portfolio_template',
		'description'     => __( 'Choose to display page content before the portfolio grid or not.', 'maker' ),
	) );

	$wp_customize->add_setting( 'maker_display_project_excerpt', array(
		'default'           => 1,
		'sanitize_callback' => 'maker_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'maker_display_project_excerpt', array(
		'label'           => __( 'Display Project Excerpt', 'maker' ),
		'section'         => 'maker_portfolio',
		'type'            => 'checkbox',
		'active_callback' => 'maker_is_single_portfolio',
	) );

	$wp_customize->add_setting( 'maker_display_project_meta', array(
		'default'           => 1,
		'sanitize_callback' => 'maker_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'maker_display_project_meta', array(
		'label'           => __( 'Display Project Meta', 'maker' ),
		'section'         => 'maker_portfolio',
		'type'            => 'checkbox',
		'active_callback' => 'maker_is_single_portfolio',
	) );

	$wp_customize->add_setting( 'maker_all_projects_link', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'maker_all_projects_link', array(
		'label'           => __( 'Link to all projects', 'maker' ),
		'section'         => 'maker_portfolio',
		'type'            => 'text',
		'active_callback' => 'maker_is_single_portfolio',
		'description'     => __( '"All Projects" link at the bottom of a single project. Links to portfolio archive if left empty.', 'maker' ),
	) );

	$wp_customize -> add_control(
		new Maker_Message_Pro_Control(
			$wp_customize,
			'maker_pro_colors',
			array(
				'label'       => __( 'Custom Colors', 'maker' ),
				'description' => __( 'Upgrade Maker and create your own color schemes, changing the color of links, text and background.', 'maker' ),
				'url'         => 'https://creativemarket.com/ThemePatio/604561-Maker-%E2%80%93-Portfolio-WordPress-Theme',
				'cta'         => __( 'Upgrade Maker', 'maker' ),
				'section'     => 'colors',
				'settings'    => array(),
			)
		)
	);

	$wp_customize -> add_control(
		new Maker_Message_Pro_Control(
			$wp_customize,
			'maker_pro_portfolio_columns',
			array(
				'label'           => __( 'Portfolio Columns', 'maker' ),
				'description'     => __( 'Upgrade Maker and set <strong>2, 3</strong> or <strong>4</strong>-column layout for the portfolio grid page.', 'maker' ),
				'url'             => 'https://creativemarket.com/ThemePatio/604561-Maker-%E2%80%93-Portfolio-WordPress-Theme',
				'cta'             => __( 'Upgrade Maker', 'maker' ),
				'section'         => 'maker_portfolio',
				'settings'        => array(),
				'active_callback' => 'maker_is_portfolio_template',
			)
		)
	);

	// Footer.
	$wp_customize->add_section( 'maker_footer' , array(
		'title'    => __( 'Footer', 'maker' ),
		'priority' => 160,
	) );

	$wp_customize -> add_control(
		new Maker_Message_Pro_Control(
			$wp_customize,
			'maker_pro_footer',
			array(
				'label'       => __( 'Footer Message', 'maker' ),
				'description' => __( 'Upgrade Maker and set your own custom footer message.', 'maker' ),
				'url'         => 'https://creativemarket.com/ThemePatio/604561-Maker-%E2%80%93-Portfolio-WordPress-Theme',
				'cta'         => __( 'Upgrade Maker', 'maker' ),
				'section'     => 'maker_footer',
				'settings'    => array(),
			)
		)
	);
}
add_action( 'customize_register', 'maker_customize_register' );


/**
 * Checks if the current page is a single portfolio item.
 */
function maker_is_single_portfolio() {
	if ( is_singular( 'portfolio' ) || is_singular( 'jetpack-portfolio' ) ) {
		return true;
	}
	return false;
}

/**
 * Checks if the current page uses one of the portfolio templates.
 */
function maker_is_portfolio_template() {
	if ( is_page_template( 'templates/portfolio-toolkit.php' ) || is_page_template( 'templates/portfolio-jetpack.php' ) ) {
		return true;
	}
}

/**
 * Checks if the current page is not one of the portfolio templates.
 */
function maker_not_portfolio_template() {
	return ! maker_is_portfolio_template() && ! maker_is_single_portfolio();
}

/**
 * Sanitizes text.
 *
 * @param string $input potentially dangerous data.
 */
function maker_sanitize_text( $input ) {
	global $allowedtags;
	return wp_kses( $input , $allowedtags );
}

/**
 * Sanitizes checkbox.
 *
 * @param string|int $input potentially dangerous data.
 */
function maker_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return 1;
	} else {
		return 0;
	}
}

/**
 * Sanitizes Image Upload.
 *
 * @param string $input potentially dangerous data.
 */
function maker_sanitize_image( $input ) {
	$output = '';

	$filetype = wp_check_filetype( $input );
	if ( $filetype['ext'] && wp_ext2type( $filetype['ext'] ) === 'image' ) {
		$output = esc_url( $input );
	}

	return $output;
}

/**
 * Binds js handlers to make theme customizer preview reload changes asynchronously.
 */
function maker_customize_preview_js() {
	wp_enqueue_script(
		'maker_customizer',
		get_template_directory_uri() . '/assets/js/customizer.js',
		array( 'customize-preview' ),
		MAKER_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'maker_customize_preview_js' );

/**
 * Prints CSS for customizer screen.
 */
function maker_customize_preview_css() {
	?>
	<style>
		.pro-badge {
			margin-left: 12px;
			padding: 0 5px 1px;
			border-radius: 3px;
			color: #fff;
			background-color: #0085ba;
			font-size: 11px;
			letter-spacing: 1px;
			text-transform: uppercase;
		}
		.customize-control-paragraph {
			margin-top: 0;
		}
	</style><?php
}
add_action( 'customize_controls_print_styles', 'maker_customize_preview_css' );
