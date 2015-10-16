/*
 * Custom theme scripts.
 */
jQuery( document ).ready( function( $ ) {
	// Fitvids.
	function makerFitvids() {
		$( 'article iframe' ).not( '.fitvid iframe' ).wrap( '<div class=\'fitvid\'/>' );
		$( '.fitvid' ).fitVids();
	}
	makerFitvids();
} );
