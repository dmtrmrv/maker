/*
 * Custom theme scripts.
 */
( function( $ ) {
	// Fitvids.
	function makerFitvids() {
		$( 'article iframe' ).not( '.fitvid iframe' ).wrap( '<div class=\'fitvid\'/>' );
		$( '.fitvid' ).fitVids();
	}
	makerFitvids();
} ) ( jQuery );

/**
 * Adds a 'last-page' class to 'nav-links' if necessary.
 */
( function() {
	// Try to get the pagination.
	var nav = document.querySelector( '.nav-links' );

	// Look for 'next' class within 'nav-links'.
	if ( nav && ! nav.querySelector( '.next' ) ) {
		// Add 'last-page' class to 'nav-links' if not found.
		nav.className += ' last-page';
	}
} )();

/**
 * Adds 'focus' class to portfolio projects.
 */
( function() {
	var projects = document.querySelector( '.portfolio-grid' );

	if ( 'undefined' !== projects ) {

		var links = projects.getElementsByTagName( 'a' );

		for ( n = 0, len = links.length; n < len; n++ ) {
			links[n].addEventListener( 'focus', toggleFocus, true );
			links[n].addEventListener( 'blur', toggleFocus, true );
		}

		/**
		 * Sets or removes .focus class on an element.
		 */
		function toggleFocus() {

			var self = this;

			// Move up until .portfolio-grid.
			while ( -1 === self.className.indexOf( 'portfolio-grid' ) ) {

				// Change class of an article element.
				if ( 'article' === self.tagName.toLowerCase() ) {
					if ( -1 !== self.className.indexOf( 'focus' ) ) {
						self.className = self.className.replace( ' focus', '' );
					} else {
						self.className += ' focus';
					}
				}

				self = self.parentElement;
			}
		}
	}
} )();
