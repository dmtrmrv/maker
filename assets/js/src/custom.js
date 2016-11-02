/*
 * Custom theme scripts.
 */

/**
 * Adds a 'last-page' class to 'prev' link within the pagination.
 */
( function() {
	// Try to get the 'prev' link within the pagination.
	var navPrev = document.querySelector( '.page-numbers.prev' ),
			navNext = document.querySelector( '.page-numbers.next' );

	// Check if we have a 'next' link within pagination.
	if ( navPrev && ! navNext ) {
		// Add 'last-page' class to 'prev' link if it is not there.
		if ( -1 === navPrev.className.indexOf( 'last-page' ) ) {
				navPrev.className += ' last-page';
		}
	}
} )();

/**
 * Adds 'focus' class to portfolio projects.
 */
( function() {
	var projects = document.querySelector( '.portfolio-grid' );

	if ( projects ) {

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
