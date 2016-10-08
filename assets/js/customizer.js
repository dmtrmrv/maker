/**
 * Theme Customizer enhancements for a better user experience.
 */

( function( $ ) {
	// Site title text.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Toggle site title visibility.
	wp.customize( 'display_blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).toggleClass( 'screen-reader-text', !to );
		} );
	} );

	// Site description text.
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Toggle site tagline visibility.
	wp.customize( 'display_blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).toggleClass( 'screen-reader-text', !to );
		} );
	} );
} )( jQuery );
