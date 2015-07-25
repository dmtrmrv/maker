/**
 * Wraps captions inside galleries with links.
 *
 * If a gallery item has a caption, and the gallery is set to link to
 * media file or attachement page, this function wraps caption tag with a link.
 */
( function() {
	// Get all galleries. Supporting IE9 and greater.
	galleries = document.getElementsByClassName( 'gallery' );
	if ( !galleries ) {
		return;
	}

	// Loop through galleries.
	for ( var i = 0; i < galleries.length; i++ ) {

		var gallery = galleries[ i ];
		var items = gallery.getElementsByTagName( 'figure' );

		// Loop through items in a single gallery.
		for ( var n = 0; n < items.length; n++ ) {

			// Try to get caption.
			var item = items[ n ];
			var caption = item.getElementsByTagName( 'figcaption' )[0];

			// If caption found and item has link, wrap caption with the same link.
			if ( 'undefined' !== typeof caption ) {
				var link = item.getElementsByTagName( 'a' )[0];
				if ( 'undefined' === typeof link ) {
					return;
				} else {
					var url = link.getAttribute( 'href' );
					var text = caption.innerHTML.trim();

					caption.innerHTML = text.link( url );
				}
			}
		}
	}
} )();
