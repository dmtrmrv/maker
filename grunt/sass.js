module.exports = {
	default: {
		options: {
			style:     'expanded',
			sourcemap: 'none',
			require:   'susy'
		},
		files: {
			'style.css': 'assets/css/sass/style.scss',
			'assets/css/editor-style.css': 'assets/css/sass/editor-style.scss'
		}
	}
};
