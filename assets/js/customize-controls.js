/**
 * Theme Customizer enhancements for a better user experience.
 */

( function( api, $ ) {
	'use strict';
	api.bind( 'ready', function() {
		api( 'portfolio_all_projects_link_type', function( setting ) {
			api.control( 'project_all_projects_link', function( control ) {
				setting.bind( function( value ) {
					control.container.toggle( 'custom' === value );
				} );
			} );
		} );
	} );
} ) ( wp.customize, jQuery );
