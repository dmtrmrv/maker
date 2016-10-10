/**
 * Load Getting Started content.
 */
( function( $ ) {
	$.ajax( {
		url: 'https://docs.themepatio.com/wp-json/wp/v2/posts/27',
		success: function ( data ) {
			$( '#tp-theme-info-title' ).html( data.title.rendered );
			$( '#tp-theme-info-text' ).html( data.content.rendered );
		},
		error: function() {
			$( '#tp-theme-info-loading' ).hide();
			$( '#tp-theme-info-error' ).show();
		},
		cache: false
	} );
} ) ( jQuery );
