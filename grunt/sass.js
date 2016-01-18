module.exports = {
	default: {
		options: {
			style:     'expanded',
			sourcemap: 'none',
			require:   'susy'
		},
		files: {
			'style.css':                                       'sass/style.scss',
			'editor-style.css':                                'sass/editor-style.scss',
			'inc/theme-info-screen/css/theme-info-screen.css': 'sass/theme-info-screen.scss'
		}
	}
};
