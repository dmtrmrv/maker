/**
 * Theme Customizer enhancements for a better user experience.
 */

( function( api, $ ) {
	// Site title text.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Toggle site title visibility.
	api( 'display_blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).toggleClass( 'screen-reader-text', ! to );
		} );
	} );

	// Site description text.
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Toggle site tagline visibility.
	api( 'display_blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).toggleClass( 'screen-reader-text', ! to );
		} );
	} );

	// Toggle the visibility of page content on a portfolio grid page.
	api( 'maker_display_portfolio_text', function( value ) {
		value.bind( function( to ) {
			$( '.portfolio-grid-content' ).toggleClass( 'screen-reader-text', ! to );
		} );
	} );

	// Toggle the visibility of the portfolio project excerpt.
	api( 'maker_display_project_excerpt', function( value ) {
		value.bind( function( to ) {
			$( '.project-excerpt' ).toggleClass( 'screen-reader-text', ! to );
			$( 'body' ).toggleClass( 'no-excerpt', ! to );
		} );
	} );

	// Toggle the visibility of the portfolio item project meta.
	api( 'maker_display_project_meta', function( value ) {
		value.bind( function( to ) {
			$( '.project-meta' ).toggleClass( 'screen-reader-text', ! to );
		} );
	} );

} )( wp.customize, jQuery );
