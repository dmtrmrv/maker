module.exports = {
	styles: {
		files: [ 'sass/*.scss', 'sass/**/*.scss' ],
		tasks: [ 'css', 'clean:release', 'copy:release' ],
		options: {
			livereload: true
		}
	},
	scripts: {
		files: [ 'js/*.js', '!js/theme.js', '!js/theme.min.js' ],
		tasks: [ 'js', 'clean:release', 'copy:release' ],
	},
	php: {
		files: [ '**/*.php', '*.php' ],
		tasks: [ 'clean:release', 'copy:release' ],
	}
}
