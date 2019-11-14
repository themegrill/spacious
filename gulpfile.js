'use strict';

var gulp         = require( 'gulp' ),
	browserSync  = require( 'browser-sync' ).create(),
	sass         = require( 'gulp-sass' ),
	postcss      = require( 'gulp-postcss' ),
	autoprefixer = require( 'autoprefixer' ),
	rename       = require( 'gulp-rename' ),
	notify       = require( 'gulp-notify' ),
	wpPot        = require( 'gulp-wp-pot' ),
	zip          = require( 'gulp-zip' );

/**
 * Project information.
 */
var info = {
    name       : 'Spacious',
    slug       : 'spacious',
    url        : 'https://themegrill.com/themes/spacious/',
    author     : 'ThemeGrill',
    authorUrl  : 'https://themegrill.com/wordpress-themes/',
    authorEmail: 'themegrill@gmail.com',
    teamEmail  : 'team@themegrill.com'
};

// Define paths
var paths = {
	js: {
		src: './js/*.js',
		dest: './js/'
	},
	elementorStyles: {
		src: './inc/elementor/assets/SCSS/**/*.scss',
		dest: './inc/elementor/assets/css/'
	},
	styles: {
		src: './assets/scss/**/*.scss',
		dest: './'
	},
	php: {
		src: [ './*.php', './post-templates/*.php' ]
	},
	zip   : {
		src: [
			'**',
			'!.*',
			'!*.md',
			'!*.zip',
			'!.*/**',
			'!dist/**',
			'!Gruntfile.js',
			'!package.json',
			'!node_modules/**'
		],
		dest: './dist',
	}
};

// Start browserSync
function browserSyncStart( cb ) {
	browserSync.init( {
		proxy: 'spacious.local'
	}, cb );
}

// Reloads the browser
function browserSyncReload( cb ) {
	browserSync.reload();
	cb();
}

function elementorStylesCompile() {
	return gulp.src( paths.elementorStyles.src )
		.pipe( sass( {
			indentType: 'tab',
			indentWidth: 1,
			outputStyle: 'expanded',
			linefeed: 'crlf'
		} ).on( 'error', sass.logError ) )
		.pipe( postcss( [
			autoprefixer( {
				browsers: [ 'last 2 versions' ],
				cascade: false
			} )
		] ) )
		.pipe( gulp.dest( paths.elementorStyles.dest ) )
		.pipe( browserSync.stream() );
}


function sassCompile() {
	return gulp.src( paths.styles.src )
		.pipe( sass( {
			indentType: 'tab',
			indentWidth: 1,
			outputStyle: 'expanded',
			linefeed: 'crlf'
		} ).on( 'error', sass.logError ) )
		.pipe( postcss( [
			autoprefixer( {
				browsers: [ 'last 2 versions' ],
				cascade: false
			} )
		] ) )
		.pipe( gulp.dest( paths.styles.dest ) )
		.pipe( browserSync.stream() );
}

// Generates  translation file.
function generatePotFile() {
    return gulp
        .src( paths.php.src )
        .pipe(
           wpPot( {
                domain   : info.slug,
                package  : info.name,
                bugReport: info.authorEmail,
                team     : info.teamEmail
            } )
        )
        .pipe( gulp.dest( 'languages/' + info.slug + '-pro.pot' ) )
        .on( 'error', notify.onError() );
}

// Watch for file changes
function watch() {
	gulp.watch( paths.elementorStyles.src, elementorStylesCompile );
	gulp.watch( paths.styles.src, sassCompile );
	// gulp.watch( [ paths.js.src, paths.php.src ], browserSyncReload );
}


// define series of tasks
var server = gulp.series( browserSyncStart, watch );

exports.browserSyncStart = browserSyncStart;
exports.browserSyncReload = browserSyncReload;
exports.elementorStylesCompile = elementorStylesCompile;
exports.sassCompile = sassCompile;
exports.watch = watch;
exports.server = server;
exports.generatePotFile        = generatePotFile;
exports.compressZip            = compressZip;
