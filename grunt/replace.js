module.exports = {
	// Add empty lines after curly braces.
	lineAfterBrace: {
		src: [
			'style.css',
			'assets/css/editor-style.css'
		],
		overwrite: true,
		replacements: [ {
			from: /\}\n(?!\n)(?!\})|\}(?=.)/g,
			to: function() {
				return '}\n\n';
			}
		} ]
	},

	// Add empty lines after DocBlocks and comments.
	lineAfterDocblock: {
		src: [
			'style.css',
			'assets/css/editor-style.css'
		],
		overwrite: true,
		replacements: [ {
			from: /\*\/\n(?!\n)|\*\/(?=.)/g,
			to: function() {
				return '*/\n\n';
			}
		} ]
	},

	// Replace theme version in project.scss
	versionStyle: {
		src: [
			'assets/css/sass/project.scss',
		],
		overwrite: true,
		replacements: [ {
			from: /Version:.*$/m,
			to:   'Version:     <%= package.version %>' // Exactly 5 spaces.
		} ]
	},

	// Replace theme version in README.txt
	versionReadme: {
		src: [
			'README.txt',
		],
		overwrite: true,
		replacements: [ {
			from: /Version:.*$/m,
			to:   'Version:           <%= package.version %>' // Exactly 11 spaces.
		} ]
	},

	// Replace version in functions.php
	versionFunctions: {
		src: [
			'functions.php'
		],
		overwrite: true,
		replacements: [ {
			from: /define\(.*(?=\_VERSION\',\s*\'\d\.\d\.\d\'\s*\)\;).*$/m,
			to:   'define( \'<%= package.name.toUpperCase() %>_VERSION\', \'<%= package.version %>\' );'
		} ]
	}
}
