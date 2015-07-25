module.exports = function( grunt ) {
	require( 'time-grunt' )( grunt );
	require( 'load-grunt-config' )( grunt, {
		jitGrunt: {
			staticMappings: {
				'replace': 'grunt-text-replace',
				'makepot': 'grunt-wp-i18n'
			}
		}
	} );
};
