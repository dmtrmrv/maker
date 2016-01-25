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

	// Logo.
	$wp_customize->add_setting( 'maker_logo', array(
		'sanitize_callback' => 'maker_sanitize_image',
	) );

	$wp_customize -> add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'maker_logo',
			array(
				'label'   => __( 'Logo', 'maker' ),
				'section' => 'title_tagline',
			)
		)
	);

	// Display Title.
	$wp_customize->add_setting( 'maker_display_title', array(
		'default' => 1,
		'sanitize_callback' => 'maker_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'maker_display_title', array(
		'label'   => __( 'Display Title', 'maker' ),
		'section' => 'title_tagline',
		'type'    => 'checkbox',
	) );

	// Display Tagline.
	$wp_customize->add_setting( 'maker_display_tagline', array(
		'default'           => 1,
		'sanitize_callback' => 'maker_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'maker_display_tagline', array(
		'label'   => __( 'Display Tagline', 'maker' ),
		'section' => 'title_tagline',
		'type'    => 'checkbox',
	) );

	// Portfolio.
	$wp_customize->add_section( 'maker_portfolio' , array(
		'title'    => __( 'Portfolio', 'maker' ),
		'priority' => 130,
	) );

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

	/**
	 * Pro Options preview.
	 */
	$maker_theme = wp_get_theme();

	if ( 'Maker Pro' != $maker_theme->get( 'Name' ) ) :

	// Colors.
	$wp_customize->add_setting( 'maker_pro_colors', array(
		'sanitize_callback' => '__return_false',
	) );

	$wp_customize -> add_control(
		new Maker_Message_Custom_Control(
			$wp_customize,
			'maker_pro_colors',
			array(
				'label'       => __( 'Custom Colors', 'maker' ),
				'description' => __( 'With Maker Pro child theme you can change <strong>link, text, background,</strong> and <strong>site</strong> colors.', 'maker' ),
				'url'         => 'https://themepatio.com/themes/maker/#tp-child-theme',
				'cta'         => 'Unlock Cusotm Colors',
				'section'     => 'colors',
			)
		)
	);

	// Portfolio.
	$wp_customize->add_setting( 'maker_pro_portfolio_columns', array(
		'sanitize_callback' => '__return_false',
	) );

	$wp_customize -> add_control(
		new Maker_Message_Custom_Control(
			$wp_customize,
			'maker_pro_portfolio_columns',
			array(
				'label'       => __( 'Portfolio Columns', 'maker' ),
				'description' => __( 'With Maker Pro child theme you can choose between <strong>two, three</strong> or <strong>four</strong> column layouts for portfolio grid on a homepage.', 'maker' ),
				'url'         => 'https://themepatio.com/themes/maker/#tp-child-theme',
				'cta'         => __( 'Unlock Portfolio Columns', 'maker' ),
				'section'     => 'maker_portfolio',
			)
		)
	);

	// Footer.
	$wp_customize->add_section( 'maker_footer' , array(
		'title'    => __( 'Footer', 'maker' ),
		'priority' => 160,
	) );

	$wp_customize->add_setting( 'maker_pro_footer', array(
		'sanitize_callback' => '__return_false',
	) );

	$wp_customize -> add_control(
		new Maker_Message_Custom_Control(
			$wp_customize,
			'maker_pro_footer',
			array(
				'label'       => __( 'Footer Message', 'maker' ),
				'description' => __( 'With Maker Pro child theme you can easily set your own custom footer message.', 'maker' ),
				'url'         => 'https://themepatio.com/themes/maker/#tp-child-theme',
				'cta'         => __( 'Unlock custom footer.', 'maker' ),
				'section'     => 'maker_footer',
			)
		)
	);

	endif;
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
		get_template_directory_uri() . '/js/customizer.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_preview_init', 'maker_customize_preview_js' );

/**
 * Custom CSS for customizer screen.
 */

$maker_theme = wp_get_theme();

if ( 'Maker Pro' != $maker_theme->get( 'Name' ) ) :

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
	</style><?php
}
add_action( 'customize_controls_print_styles', 'maker_customize_preview_css' );

endif;
