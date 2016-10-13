module.exports = {
	styles: {
		files: [ 'assets/css/sass/*.scss', 'assets/css/sass/**/*.scss' ],
		tasks: [ 'css', 'clean:release', 'copy:release' ],
		options: {
			livereload: true
		}
	},
	scripts: {
		files: [ 'assets/js/src/*.js', '!assets/js/project.js', '!assets/js/project.min.js' ],
		tasks: [ 'js', 'clean:release', 'copy:release' ],
		options: {
			livereload: true
		}
	},
	php: {
		files: [ '**/*.php', '*.php' ],
		tasks: [ 'clean:release', 'copy:release' ],
		options: {
			livereload: true
		}
	}
}
