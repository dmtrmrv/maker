/*
 * Custom theme scripts.
 */
jQuery( document ).ready( function( $ ) {
	// Fitvids.
	function fitvids() {
		$( 'article iframe' ).not( '.fitvid iframe' ).wrap( '<div class=\'fitvid\'/>' );
		$( '.fitvid' ).fitVids();
	}
	fitvids();

} );
