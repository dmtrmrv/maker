module.exports = {
	release: {
		src: [
			'./**',
			'!./node_modules/**',
			'!./package.json',
			'!./.csscomb.json',
			'!./Gruntfile.js',
			'!./grunt/**',
			'!./assets/css/sass/**',
			'!./assets/fonts/fontello/css/fontello-*.css',
			'!./assets/fonts/fontello/css/animation.css',
			'!./assets/fonts/fontello/config.json',
			'!./assets/fonts/fontello/demo.html',
			'!./assets/fonts/fontello/README.txt',
			'!./*.sublime-workspace',
			'!./*.sublime-project',
			'!./*.ruleset.xml',
			'!./.DS_Store',
			'!./**/.DS_Store'
		],
		dest: '../build/<%= package.name %>',
		expand: true
	}
}
