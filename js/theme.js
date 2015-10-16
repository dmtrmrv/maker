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
 * Handles toggling the navigation menu for small screens.
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = document.getElementById( 'site-navigation-toggle' );
	if ( ! button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

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
			button.className    += ' toggled';
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};
} )();

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
