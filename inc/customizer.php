<?php
/**
 * Maker Customizer Settings.
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
		'title' => __( 'Portfolio', 'maker' ),
	) );

	$wp_customize -> add_control(
		new Maker_Message_Control(
			$wp_customize,
			'maker_portfolio',
			array(
				'label'           => __( 'Navigate to Portfolio', 'maker' ),
				'settings'        => array(),
				'description'     => __( 'To edit the portfolio, navigate to portfolio grid page in the preview screen.', 'maker' ),
				'section'         => 'maker_portfolio',
				'active_callback' => 'maker_not_portfolio_template',
			)
		)
	);

	// Portfolio Page Content.
	$wp_customize->add_setting( 'portfolio_display_page_content', array(
		'default'           => 1,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'maker_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'portfolio_display_page_content', array(
		'label'           => __( 'Display Page Content', 'maker' ),
		'section'         => 'maker_portfolio',
		'type'            => 'checkbox',
		'active_callback' => 'maker_is_portfolio_template',
		'description'     => __( 'Appears before the portfolio grid.', 'maker' ),
	) );

	// Porfolio Project Excerpt.
	$wp_customize->add_setting( 'project_display_excerpt', array(
		'default'           => 1,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'maker_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'project_display_excerpt', array(
		'label'           => __( 'Display Project Excerpt', 'maker' ),
		'section'         => 'maker_portfolio',
		'type'            => 'checkbox',
		'active_callback' => 'maker_is_single_portfolio',
	) );

	// Portfolio Project Meta.
	$wp_customize->add_setting( 'project_display_meta', array(
		'default'           => 1,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'maker_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'project_display_meta', array(
		'label'           => __( 'Display Project Meta', 'maker' ),
		'section'         => 'maker_portfolio',
		'type'            => 'checkbox',
		'active_callback' => 'maker_is_single_portfolio',
	) );

	// All Projects link type.
	$wp_customize->add_setting( 'portfolio_all_projects_link_type', array(
		'default'   => 'archive',
		'transport' => 'postMessage',
		'sanitize_callback' => 'maker_sanitize_portfolio_all_projects_link_type',
	) );

	$wp_customize->add_control( 'portfolio_all_projects_link_type', array(
		'label'   => __( 'All Projects links to', 'maker' ),
		'section' => 'maker_portfolio',
		'type'    => 'radio',
		'active_callback' => 'maker_is_single_portfolio',
		'choices' => array(
			'archive'   => __( 'Archive', 'maker' ),
			'frontpage' => __( 'Frontpage', 'maker' ),
			'custom'    => __( 'Custom URL', 'maker' ),
		),
	) );

	// All Projects link.
	$wp_customize->add_setting( 'project_all_projects_link', array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'project_all_projects_link', array(
		'label'           => __( 'Link to all projects', 'maker' ),
		'section'         => 'maker_portfolio',
		'type'            => 'text',
		'active_callback' => function () {
			return 'custom' === get_theme_mod( 'portfolio_all_projects_link_type' ) && maker_is_single_portfolio();
		},
	) );

	// Colors.
	$wp_customize->add_control( new Maker_Message_Pro_Control( $wp_customize, 'maker_pro_colors', array(
		'label'       => __( 'Custom Colors', 'maker' ),
		'description' => __( 'Upgrade Maker and create your own color schemes, changing the color of links, text and background.', 'maker' ),
		'url'         => 'https://themepatio.com/themes/maker/?utm_source=maker-lite&utm_medium=colors',
		'cta'         => __( 'Upgrade Maker', 'maker' ),
		'section'     => 'colors',
		'settings'    => array(),
	) ) );

	// Portfolio Column number.
	$wp_customize -> add_control( new Maker_Message_Pro_Control( $wp_customize, 'maker_pro_portfolio_columns', array(
		'label'           => __( 'Portfolio Columns', 'maker' ),
		'description'     => __( 'Upgrade Maker and set <strong>2, 3</strong> or <strong>4</strong>-column layout for the portfolio grid page.', 'maker' ),
		'url'             => 'https://themepatio.com/themes/maker/?utm_source=maker-lite&utm_medium=columns',
		'cta'             => __( 'Upgrade Maker', 'maker' ),
		'section'         => 'maker_portfolio',
		'settings'        => array(),
		'active_callback' => 'maker_is_portfolio_template',
	) ) );

	// Footer text.
	$wp_customize->add_section( 'maker_footer' , array(
		'title'    => __( 'Footer', 'maker' ),
	) );

	$wp_customize -> add_control( new Maker_Message_Pro_Control( $wp_customize, 'maker_pro_footer', array(
		'label'       => __( 'Footer Message', 'maker' ),
		'description' => __( 'Upgrade Maker and set your own custom footer message.', 'maker' ),
		'url'         => 'https://themepatio.com/themes/maker/?utm_source=maker-lite&utm_medium=footer-text',
		'cta'         => __( 'Upgrade Maker', 'maker' ),
		'section'     => 'maker_footer',
		'settings'    => array(),
	) ) );
}
add_action( 'customize_register', 'maker_customize_register' );

/**
 * Checks if the current page is a single portfolio item.
 */
function maker_is_single_portfolio() {
	return is_singular( 'portfolio' ) || is_singular( 'jetpack-portfolio' );
}

/**
 * Checks if the current page uses one of the portfolio templates.
 */
function maker_is_portfolio_template() {
	return is_page_template( 'templates/portfolio-toolkit.php' ) || is_page_template( 'templates/portfolio-jetpack.php' );
}

/**
 * Checks if the current page is not of the portfolio templates.
 */
function maker_not_portfolio_template() {
	return ! maker_is_portfolio_template() && ! maker_is_single_portfolio();
}

/**
 * Sanitizes checkbox.
 *
 * @param string|int $input Potentially harmful data.
 */
function maker_sanitize_checkbox( $input ) {
	return 1 == $input ? 1 : 0;
}

/**
 * Sanitizes column option.
 *
 * @param  int $input Potentially harmful data.
 */
function maker_sanitize_number_of_columns( $input ) {
	return in_array( $input, array( 2, 3, 4 ) ) ? $input : 3;
}

/**
 * Sanitizes the type of the "All Projects" link type.
 *
 * @param  string $input Potentially harmful data.
 * @return string        Link type.
 */
function maker_sanitize_portfolio_all_projects_link_type( $input ) {
	if ( in_array( $input, array( 'archive', 'frontpage', 'custom' ) ) ) {
		return $input;
	}
	return 'archive';
}

/**
 * Enqueue custom scripts for customizer controls.
 */
function maker_customize_control_js() {
	wp_enqueue_script(
		'maker-customize-controls',
		get_template_directory_uri() . '/assets/js/customize-controls.js',
		array( 'jquery', 'customize-controls' ),
		MAKER_VERSION,
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'maker_customize_control_js' );

/**
 * Enqueue custom scripts for customizer preview screen.
 */
function maker_customize_preview_js() {
	wp_enqueue_script(
		'maker-customize-preview',
		get_template_directory_uri() . '/assets/js/customize-preview.js',
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
