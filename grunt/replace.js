module.exports = {
	// Add empty lines after curly braces.
	line_after_brace: {
		src: [ 'style.css', 'editor-style.css' ],
		overwrite: true,
		replacements: [ {
			from: /\}\n(?!\n)(?!\})|\}(?=.)/g,
			to: function() {
				return '}\n\n';
			}
		} ]
	},

	// Add empty lines after DocBlocks and comments.
	line_after_docblock: {
		src: [ 'style.css', 'editor-style.css' ],
		overwrite: true,
		replacements: [ {
			from: /\*\/\n(?!\n)|\*\/(?=.)/g,
			to: function() {
				return '*/\n\n';
			}
		} ]
	},

	// Replace theme version in style.scss
	version_style: {
		src: [
			'sass/style.scss',
		],
		overwrite: true,
		replacements: [ {
			from: /Version:.*$/m,
			to: 'Version: <%= package.version %>'
		} ]
	},

	// Replace version in functions.php
	version_functions: {
		src: [
			'functions.php'
		],
		overwrite: true,
		replacements: [ {
			from: /^define\( 'PRIMER_VERSION'.*$/m,
			to: 'define( \'PRIMER_VERSION\', \'<%= package.version %>\' );'
		} ]
	},

	prefixes: {
		src: [
			'**/*.php',
			'js/**/*.js',
			'sass/**/*.scss',
		],
		overwrite: true,
		replacements: [ {
			from: /primer_/g,
			to: '<%= package.name %>_'
		} ]
	},

	handles: {
		src: [
			'**/*.php',
			'js/**/*.js',
			'sass/**/*.scss',
		],
		overwrite: true,
		replacements: [ {
			from: /primer-/g,
			to: '<%= package.name %>-'
		} ]
	},

	textdomain: {
		src: [
			'**/*.php'
		],
		overwrite: true,
		replacements: [ {
			from: /'primer'/g,
			to: '\'<%= package.name %>\''
		} ]
	},

	constants: {
		src: [
			'**/*.php',
		],
		overwrite: true,
		replacements: [ {
			from: /PRIMER/g,
			to: function() {
				return '<%= package.name.toUpperCase() %>';
			}
		} ]
	},

	misc: {
		src: [
			'**/*.php',
			'js/**/*.js',
			'sass/**/*.scss',
		],
		overwrite: true,
		replacements: [ {
			// DocBlocks. Space before string.
			from: / Primer/g,
			to: function() {
				var name = '<%= package.fullname %>';
				return ' ' + name;
			}
		}, {
			// DocBlocks. Space after string.
			from: /Primer /g,
			to: function() {
				var name = '<%= package.fullname %>';
				return name + ' ';
			}
		}, {
			// DocBlocks. Space before and lowercase.
			from: / primer/g,
			to: ' <%= package.name %>'
		}, {
			// Theme name in footer.
			from: /'Primer'/g,
			to: function() {
				var name = '<%= package.fullname %>';
				return '\'' + name + '\'';
			}
		} ]
	},

	self: {
		src: [
			'grunt/*.js',
		],
		overwrite: true,
		replacements: [ {
			from: /primer/g,
			to: '<%= package.name %>'
		}, {
			from: /Primer/g,
			to: '<%= package.fullname %>'
		}, {
			from: /PRIMER/g,
			to: function() {
				return '<%= package.name.toUpperCase() %>';
			}
		} ]
	}
}
