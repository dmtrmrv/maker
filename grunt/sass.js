var sass = require('node-sass');

module.exports = {
	default: {
		options: {
			style:     'expanded',
			sourcemap: 'none',
			implementation: sass,
			precision: 5
		},
		files: {
			'style.css':                    'assets/css/sass/project.scss',
			'assets/css/editor-style.css':  'assets/css/sass/editor-style.scss'
		}
	}
};
