module.exports = {
	release: {
		options: {
			archive: '../build/maker.zip'
		},
		src: [
			'./**',
			'!./node_modules/**',
			'!./package.json',
			'!./.csscomb.json',
			'!./Gruntfile.js',
			'!./grunt/**',
			'!./sass/**',
			'!./*.sublime-workspace',
			'!./*.sublime-project',
			'!./.DS_Store',
			'!./**/.DS_Store'
		],
	}
}
