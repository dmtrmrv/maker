<?php
/**
 * Maker functions and definitions.
 *
 * @package Maker
 */

/**
 * The current version of the theme.
 */
define( 'MAKER_VERSION', '0.2.0' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

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
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Maker, use a find and replace
	 * to change 'maker' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'maker', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'maker-thumbnail',           '729', '432', true );
	add_image_size( 'maker-thumbnail-fullwidth', '984', '576', true );
	add_image_size( 'maker-thumbnail-portfolio', '480', '480', true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'maker' ),
		'footer'  => __( 'Footer Menu',  'maker' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'editor-style.css' ) );
}
endif;
add_action( 'after_setup_theme', 'maker_setup' );


/**
 * Adjust content_width value for fullwidth page and portfolio pages.
 */
function maker_content_width() {
	if ( is_page_template( 'templates/fullwidth.php' ) || 'portfolio' == get_post_type() || 'jetpack-portfolio' == get_post_type() ) {
		$GLOBALS['content_width'] = 984;
	}
}
add_action( 'template_redirect', 'maker_content_width' );

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
		get_template_directory_uri() . '/fonts/fontello/css/fontello.css',
		array()
	);

	wp_enqueue_style(
		'maker-style',
		get_stylesheet_uri()
	);

	wp_enqueue_script(
		'maker-navigation',
		get_template_directory_uri() . '/js/navigation.js',
		array(),
		MAKER_VERSION,
		true
	);

	wp_enqueue_script(
		'maker-skip-link-focus-fix',
		get_template_directory_uri() . '/js/skip-link-focus-fix.js',
		array(),
		MAKER_VERSION,
		true
	);

	wp_enqueue_script(
		'maker-gallery-captions',
		get_template_directory_uri() . '/js/gallery-captions.js',
		array(),
		MAKER_VERSION,
		true
	);

	wp_enqueue_script(
		'maker-fitvids',
		get_template_directory_uri() . '/js/jquery.fitvids.js',
		array( 'jquery' ),
		MAKER_VERSION,
		true
	);

	wp_enqueue_script(
		'maker-custom',
		get_template_directory_uri() . '/js/custom.js',
		array( 'jquery' ),
		MAKER_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*
	 * Do the same thing with Contact Form 7.
	 */
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

/**
 * Theme Info Screen
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/theme-info-screen/theme-info-screen.php';
}
