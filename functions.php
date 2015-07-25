<?php
/**
 * Primer functions and definitions
 *
 * @package Primer
 */

/**
 * The current version of the theme.
 */
define( 'PRIMER_VERSION', '1.0.0' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 729; /* pixels */
}

if ( ! function_exists( 'primer_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function primer_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Primer, use a find and replace
	 * to change 'primer' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'primer', get_template_directory() . '/languages' );

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

	add_image_size( 'primer-thumbnail', '729', '432', true );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'primer' ),
		'footer' => __( 'Footer Menu', 'primer' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'primer_custom_background_args', array(
		'default-color' => 'fafafa',
		'default-image' => '',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'editor-style.css' ) );
}
endif; // primer_setup
add_action( 'after_setup_theme', 'primer_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function primer_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'primer' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'primer_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function primer_scripts() {

	wp_enqueue_style(
		'primer-fontello',
		get_template_directory_uri() . '/fonts/fontello/css/fontello.css',
		array()
	);

	wp_enqueue_style(
		'primer-style',
		get_stylesheet_uri()
	);

	wp_enqueue_script(
		'primer-navigation',
		get_template_directory_uri() . '/js/navigation.js',
		array(),
		PRIMER_VERSION,
		true
	);

	wp_enqueue_script(
		'primer-skip-link-focus-fix', 
		get_template_directory_uri() . '/js/skip-link-focus-fix.js',
		array(),
		PRIMER_VERSION,
		true
	);

	wp_enqueue_script(
		'primer-gallery-captions',
		get_template_directory_uri() . '/js/gallery-captions.js',
		array(),
		PRIMER_VERSION,
		true
	);
	
	wp_enqueue_script(
		'primer-fitvids',
		get_template_directory_uri() . '/js/jquery.fitvids.js',
		array( 'jquery' ),
		PRIMER_VERSION,
		true
	);
	
	wp_enqueue_script(
		'primer-custom',
		get_template_directory_uri() . '/js/custom.js',
		array( 'jquery' ),
		PRIMER_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*
	 * We have styles for Jetpack infinite scroll.
	 * Let's save one request and some bandwidth. Shall we?
	 */
	if ( wp_style_is( 'the-neverending-homepage', 'registered' ) ) {
		wp_deregister_style( 'the-neverending-homepage' );
	}

	/*
	 * Do the same thing with Contact Form 7.
	 */
	if ( wp_style_is( 'contact-form-7', 'registered' ) ) {
		wp_deregister_style( 'contact-form-7' );
	}
}
add_action( 'wp_enqueue_scripts', 'primer_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer-controls/textarea.php';
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';