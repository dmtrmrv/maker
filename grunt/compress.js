module.exports = {
	release: {
		options: {
			archive: '../build/<%= package.name %>-<%= package.version %>.zip',
			mode: 'zip'
		},
		expand: true,
		cwd: '../build/',
		src: ['<%= package.name %>/**']
	},
	pro: {
		options: {
			archive: '../build/<%= package.name %>-pro-<%= package.version %>.zip',
			mode: 'zip'
		},
		expand: true,
		cwd: '../build/',
		src: ['<%= package.name %>/**']
	}
}
