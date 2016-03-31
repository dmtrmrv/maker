module.exports = {
	release: {
		src: [
			'./**',
			'!./sass-cache/**',
			'!./grunt/**',
			'!./node_modules/**',
			'!./.csscomb.json',
			'!./.gitignore',
			'!./.jscs.json',
			'!./.travis.yml',
			'!./codesniffer.ruleset.xml',
			'!./Gruntfile.js',
			'!./*.sublime-workspace',
			'!./*.sublime-project',
			'!./README.md',
			'!./package.json',
			'!./assets/css/sass/**',
			'!./assets/fonts/fontello/css/fontello-*.css',
			'!./assets/fonts/fontello/css/animation.css',
			'!./assets/fonts/fontello/config.json',
			'!./assets/fonts/fontello/demo.html',
			'!./assets/fonts/fontello/README.txt',
			'!./.DS_Store',
			'!./**/.DS_Store'
		],
		dest: '../build/<%= package.name %>',
		expand: true
	}
}
