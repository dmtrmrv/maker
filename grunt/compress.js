module.exports = {
	release: {
		options: {
			archive: '../build/maker.zip'
		},
		src: [
			'./**',
			'!./README.md',
			'!./node_modules/**',
			'!./package.json',
			'!./codesniffer.ruleset.xml',
			'!./.travis.yml',
			'!./.csscomb.json',
			'!./Gruntfile.js',
			'!./grunt/**',
			'!./sass/**',
			'!./fonts/fontello/css/fontello-*.css',
			'!./fonts/fontello/css/animation.css',
			'!./fonts/fontello/config.json',
			'!./fonts/fontello/demo.html',
			'!./fonts/fontello/README.txt',
			'!./*.sublime-workspace',
			'!./*.sublime-project',
			'!./.DS_Store',
			'!./**/.DS_Store'
		],
	}
}
