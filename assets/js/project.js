/*global jQuery */
/*jshint browser:true */
/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/

;( function( $ ) {

	'use strict';

	$.fn.fitVids = function( options ) {
		var settings = {
			customSelector: null,
			ignore: null
		};

		if ( !document.getElementById( 'fit-vids-style' ) ) {
			// appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
			var head = document.head || document.getElementsByTagName( 'head' )[ 0 ];
			var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
			var div = document.createElement( "div" );
			div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
			head.appendChild( div.childNodes[ 1 ] );
		}

		if ( options ) {
			$.extend( settings, options );
		}

		return this.each( function() {
			var selectors = [
				'iframe[src*="player.vimeo.com"]',
				'iframe[src*="youtube.com"]',
				'iframe[src*="youtube-nocookie.com"]',
				'iframe[src*="kickstarter.com"][src*="video.html"]',
				'object',
				'embed'
			];

			if ( settings.customSelector ) {
				selectors.push( settings.customSelector );
			}

			var ignoreList = '.fitvidsignore';

			if ( settings.ignore ) {
				ignoreList = ignoreList + ', ' + settings.ignore;
			}

			var $allVideos = $( this ).find( selectors.join( ',' ) );
			$allVideos = $allVideos.not( 'object object' ); // SwfObj conflict patch
			$allVideos = $allVideos.not( ignoreList ); // Disable FitVids on this video.

			$allVideos.each( function( count ) {
				var $this = $( this );
				if ( $this.parents( ignoreList ).length > 0 ) {
					return; // Disable FitVids on this video.
				}
				if ( this.tagName.toLowerCase() === 'embed' && $this.parent( 'object' ).length || $this.parent( '.fluid-width-video-wrapper' ).length ) {
					return;
				}
				if ( ( !$this.css( 'height' ) && !$this.css( 'width' ) ) && ( isNaN( $this.attr( 'height' ) ) || isNaN( $this.attr( 'width' ) ) ) ) {
					$this.attr( 'height', 9 );
					$this.attr( 'width', 16 );
				}
				var height = ( this.tagName.toLowerCase() === 'object' || ( $this.attr( 'height' ) && !isNaN( parseInt( $this.attr( 'height' ), 10 ) ) ) ) ? parseInt( $this.attr( 'height' ), 10 ) : $this.height();
				var width = !isNaN( parseInt( $this.attr( 'width' ), 10 ) ) ? parseInt( $this.attr( 'width' ), 10 ) : $this.width();
				var aspectRatio = height / width;
				if ( !$this.attr( 'id' ) ) {
					var videoID = 'fitvid' + count;
					$this.attr( 'id', videoID );
				}
				$this.wrap( '<div class="fluid-width-video-wrapper"></div>' ).parent( '.fluid-width-video-wrapper' ).css( 'padding-top', ( aspectRatio * 100 ) + '%' );
				$this.removeAttr( 'height' ).removeAttr( 'width' );
			} );
		} );
	};
	// Works with either jQuery or Zepto
} )( window.jQuery || window.Zepto );

/**
 * skip-link-focus-fix.js
 */
( function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1;
	var is_opera = navigator.userAgent.toLowerCase().indexOf( 'opera' ) > -1;
	var is_ie = navigator.userAgent.toLowerCase().indexOf( 'msie' ) > -1;

	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 );
			var element;

			if ( !( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( !( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
} )();

/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens
 */

( function() {
	var container, button, menu, links, subMenus;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	button = document.getElementById( 'site-navigation-toggle' );
	if ( 'undefined' === typeof button ) {
		return;
	}

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.className    = button.className.replace( ' toggled', '' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.className += ' toggled';
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( var i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )();

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
