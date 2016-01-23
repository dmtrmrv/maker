<?php
/**
 * Maker Theme Info Screen.
 *
 * @package Maker
 */

/**
 * Creates Theme info screen.
 */
class Maker_Theme_Info_Screen {

	/**
	 * Current theme object.
	 *
	 * @var object
	 */
	private $theme;

	/**
	 * Current theme URL.
	 *
	 * @var string
	 */
	private $theme_url;

	/**
	 * Current theme Author URL
	 *
	 * @var string
	 */
	private $theme_author_url;

	/**
	 * Class Constructor.
	 */
	public function __construct() {

		$this->theme = wp_get_theme();
		$this->theme_url = $this->theme->get( 'ThemeURI' );
		$this->theme_author_url = $this->theme->get( 'AuthorURI' );

		add_action( 'admin_menu', array( $this, 'maker_theme_info_screen_register_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'maker_theme_info_screen_style' ) );

		add_action( 'maker_theme_info_screen', array( $this, 'maker_theme_info_screen_info' ), 10 );
		add_action( 'maker_theme_info_screen', array( $this, 'maker_theme_info_screen_tab_nav' ), 20 );

		add_action( 'maker_theme_info_screen_tabs', array( $this, 'maker_theme_info_screen_tab_title_features' ), 30 );
		add_action( 'maker_theme_info_screen_tabs', array( $this, 'maker_theme_info_screen_tab_title_plugins' ), 40 );
		add_action( 'maker_theme_info_screen_tabs', array( $this, 'maker_theme_info_screen_tab_title_support' ), 50 );
		add_action( 'maker_theme_info_screen_tabs', array( $this, 'maker_theme_info_screen_tab_title_pro' ), 60 );

		add_action( 'maker_theme_info_screen', array( $this, 'maker_theme_info_screen_tab_features' ), 70 );
		add_action( 'maker_theme_info_screen', array( $this, 'maker_theme_info_screen_tab_plugins' ), 80 );
		add_action( 'maker_theme_info_screen', array( $this, 'maker_theme_info_screen_tab_support' ), 90 );
		add_action( 'maker_theme_info_screen', array( $this, 'maker_theme_info_screen_tab_pro' ), 100 );

		add_action( 'maker_theme_info_screen_sidebar', array( $this, 'maker_theme_info_screen_sidebar_docs' ), 110 );
	}

	/**
	 * Enqueue theme info screen JS and CSS.
	 */
	public function maker_theme_info_screen_style() {
		wp_enqueue_style( 'maker-theme-info-screen', get_template_directory_uri() . '/inc/theme-info-screen/css/theme-info-screen.css', MAKER_VERSION );
		wp_enqueue_script( 'maker-theme-info-screen', get_template_directory_uri() . '/inc/theme-info-screen/js/theme-info-screen.js', MAKER_VERSION );
	}

	/**
	 * Creates the dashboard page.
	 */
	public function maker_theme_info_screen_register_menu() {
		add_theme_page( 'Getting Started', 'Getting Started', 'read', 'maker-getting-started', array( $this, 'maker_theme_info_screen_screen' ) );
	}

	/**
	 * Theme Info Screen.
	 */
	public function maker_theme_info_screen_screen() {
		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );

		echo '<div class="wrap tp-theme-info">';

			do_action( 'maker_theme_info_screen' );

			echo '<div class="theme-info-sidebar">';

				do_action( 'maker_theme_info_screen_sidebar' );

			echo '</div>';

		echo '</div>';

	}

	/**
	 * Welcome screen intro.
	 */
	public function maker_theme_info_screen_info() {
		require_once( get_template_directory() . '/inc/theme-info-screen/partials/intro.php' );
	}

	/**
	 * Welcome screen tabs.
	 */
	public function maker_theme_info_screen_tab_nav() {

		echo '<h2 class="nav-tab-wrapper tp-nav-tab-wrapper">';

			do_action( 'maker_theme_info_screen_tabs' );

		echo '</h2>';

	}

	/**
	 * Features Tab Title.
	 */
	public function maker_theme_info_screen_tab_title_features() {
		printf(
			'<a href="#features" class="nav-tab nav-tab-active">%s</a>',
			esc_html__( 'Features', 'maker' )
		);
	}

	/**
	 * Plugins Tab Title.
	 */
	public function maker_theme_info_screen_tab_title_plugins() {
		printf(
			'<a href="#plugins" class="nav-tab">%s</a>',
			esc_html__( 'Plugins', 'maker' )
		);
	}

	/**
	 * Support Tab Title.
	 */
	public function maker_theme_info_screen_tab_title_support() {
		printf(
			'<a href="#support" class="nav-tab">%s</a>',
			esc_html__( 'Support', 'maker' )
		);
	}

	/**
	 * Pro Tab Title.
	 */
	public function maker_theme_info_screen_tab_title_pro() {
		printf(
			'<a href="#pro" class="nav-tab %2$s">%1$s</a>',
			esc_html__( 'Maker Pro', 'maker' ),
			esc_attr( $this->maker_is_pro() ? '' : 'nav-tab-pro' )
		);
	}

	/**
	 * Features Tab.
	 */
	public function maker_theme_info_screen_tab_features() {
		require_once( get_template_directory() . '/inc/theme-info-screen/partials/tab-features.php' );
	}

	/**
	 * Plugins Tab.
	 */
	public function maker_theme_info_screen_tab_plugins() {
		require_once( get_template_directory() . '/inc/theme-info-screen/partials/tab-plugins.php' );
	}

	/**
	 * Support Tab.
	 */
	public function maker_theme_info_screen_tab_support() {
		require_once( get_template_directory() . '/inc/theme-info-screen/partials/tab-support.php' );
	}

	/**
	 * Pro Tab.
	 */
	public function maker_theme_info_screen_tab_pro() {
		require_once( get_template_directory() . '/inc/theme-info-screen/partials/tab-pro.php' );
	}

	/**
	 * Sidebar Docs.
	 */
	public function maker_theme_info_screen_sidebar_docs() {
		require_once( get_template_directory() . '/inc/theme-info-screen/partials/widget-docs.php' );
	}

	/**
	 * Checks if given plugin is installed.
	 *
	 * @param  string $path Path to the main plugin file relative to the 'plugins' folder.
	 *
	 * @return bool True if plugin is installed.
	 */
	public function maker_theme_info_screen_is_plugin_installed( $path ) {
		if ( $path ) {
			// Get the list of all plugins.
			$plugins = get_plugins();

			// Check if given plugin is in the list.
			if ( array_key_exists( $path, $plugins ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Displays the Install button for a plugin.
	 *
	 * @param  string $slug  The slug of the plugin.
	 * @param  string $path  Path to the main file of the plugin.
	 * @param  string $class Class name to check for.
	 */
	public function maker_theme_info_screen_plugin_install_button( $slug, $path, $class ) {

		// Check if plugin is installed or not.
		if ( $this->maker_theme_info_screen_is_plugin_installed( $path ) ) {
			// Check if plugin is activated or not.
			if ( is_plugin_inactive( $path ) ) {
				printf(
					'<p class="description">%s</p>',
					esc_html__( 'This plugin is installed but not activated. You need to go to the Plugins page and activate it.', 'maker' )
				);

				printf(
					'<p class="tp-theme-feature-buttons"><a href="%s" target="_blank" class="button">%s</a></p>',
					esc_url( self_admin_url( 'plugins.php' ) ),
					esc_html( 'Go to Plugins Page and Activate', 'maker' )
				);

			} else {
				printf(
					'<p class="tp-theme-feature-buttons"><span class="button button-disabled">%s</span></p>',
					esc_html__( 'Installed & Acivated', 'maker' )
				);
			}
		} else {
			printf(
				'<p class="tp-theme-feature-buttons"><a href="%s" target="_blank" class="button button-primary">%s</a></p>',
				esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $slug ), 'install-plugin_' . $slug ) ),
				esc_html( 'Install', 'maker' )
			);
		}
	}

	/**
	 * Checks if the theme is Maker Pro.
	 *
	 * @return bool True if the theme is Maker Pro.
	 */
	public function maker_is_pro() {
		if ( 'Maker Pro' == $this->theme->get( 'Name' ) ) {
			return true;
		} else {
			return false;
		}
	}
}

$GLOBALS['Maker_Theme_Info_Screen'] = new Maker_Theme_Info_Screen();
