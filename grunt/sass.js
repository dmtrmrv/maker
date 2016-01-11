module.exports = {
	default: {
		options: {
			style:     'expanded',
			sourcemap: 'none',
			require:   'susy'
		},
		files: {
			'style.css':                          'sass/style.scss',
			'editor-style.css':                   'sass/editor-style.scss',
			'inc/welcome-screen/css/welcome.css': 'sass/welcome.scss'
		}
	}
};
