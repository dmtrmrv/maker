<?php
/**
 * Maker functions and definitions.
 *
 * @package Maker
 */

/**
 * The current version of the theme.
 */
define( 'MAKER_VERSION', '0.3.5' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function maker_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'maker_content_width', 480 );
}
add_action( 'after_setup_theme', 'maker_content_width', 0 );

if ( ! function_exists( 'maker_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function maker_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'maker', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'width'       => 444,
		'height'      => 144,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// Blog thumbnail with sidebar.
	add_image_size( '738x0',  738,  0, false );
	add_image_size( '1476x0', 1458, 0, false );

	// Blog thumbnail without sidebar.
	add_image_size( '996x0',  996,  0, false );
	add_image_size( '1992x0', 1992, 0, false );

	// Portfolio thumbnail.
	add_image_size( '480x480', 480, 480, true );
	add_image_size( '960x960', 960, 960, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'maker' ),
		'footer'  => __( 'Footer Menu',  'maker' ),
	) );

	/*
	 * Enable HTML5 markup for listed features.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Add support for Pageviews plugin.
	 */
	add_theme_support( 'pageviews' );

	// Add support for Jetpack responsive videos.
	add_theme_support( 'jetpack-responsive-videos' );

	/*
	 * This theme styles the visual editor to resemble the theme style.
	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );

	/*
	 * Support for Selective Refresh for widgets.
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

}
endif;
add_action( 'after_setup_theme', 'maker_setup' );


/**
 * Adjust content_width value for fullwidth page and portfolio pages.
 */
function maker_adjust_content_width() {
	if ( is_page_template( 'templates/fullwidth.php' ) || 'portfolio' == get_post_type() || 'jetpack-portfolio' == get_post_type() ) {
		$GLOBALS['content_width'] = 996;
	}
}
add_action( 'template_redirect', 'maker_adjust_content_width' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function maker_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'maker' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'maker_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function maker_scripts() {

	wp_enqueue_style(
		'maker-fontello',
		get_template_directory_uri() . '/assets/fonts/fontello/css/fontello.css',
		array()
	);

	wp_enqueue_style(
		'maker-style',
		get_stylesheet_uri()
	);

	wp_enqueue_script(
		'maker-navigation',
		get_template_directory_uri() . '/assets/js/src/navigation.js',
		array(),
		MAKER_VERSION,
		true
	);

	wp_enqueue_script(
		'maker-skip-link-focus-fix',
		get_template_directory_uri() . '/assets/js/src/skip-link-focus-fix.js',
		array(),
		MAKER_VERSION,
		true
	);

	wp_enqueue_script(
		'maker-custom',
		get_template_directory_uri() . '/assets/js/src/custom.js',
		array(),
		MAKER_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( wp_style_is( 'contact-form-7', 'registered' ) ) {
		wp_deregister_style( 'contact-form-7' );
	}
}
add_action( 'wp_enqueue_scripts', 'maker_scripts' );

/**
 * Disable Jetpack Infinite scroll styles.
 */
function maker_disable_scripts() {
	if ( wp_style_is( 'the-neverending-homepage', 'registered' ) ) {
		wp_deregister_style( 'the-neverending-homepage' );
	}
}
add_filter( 'jetpack_implode_frontend_css', '__return_false' );
add_action( 'wp_enqueue_scripts', 'maker_disable_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer Custom Controls.
 */
require get_template_directory() . '/inc/customizer-controls.php';

/**
 * Customizer settings.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
