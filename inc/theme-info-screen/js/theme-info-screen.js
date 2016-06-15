// Tabs at theme info screen.
jQuery( document ).ready( function() {
	jQuery( 'div.tp-tab-content' ).hide();
	jQuery( 'div#features' ).show();

	jQuery( '.tp-nav-tab-wrapper a' ).click( function() {

		var tab  = jQuery( this );
		var	wrap = tab.closest( '.tp-theme-info' );

		jQuery( '.tp-nav-tab-wrapper a', wrap ).removeClass( 'nav-tab-active' );
		jQuery( 'div.tp-tab-content', wrap ).hide();
		jQuery( 'div' + tab.attr( 'href' ), wrap ).show();
		tab.addClass( 'nav-tab-active' );

		return false;
	} );
} );
