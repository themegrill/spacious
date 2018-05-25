'use strict';

var gulp = require( 'gulp' );
var browserSync = require( 'browser-sync' ).create();
var sass = require( 'gulp-sass' );
var postcss = require( 'gulp-postcss' );
var autoprefixer = require( 'autoprefixer' );

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
			outputStyle: 'expanded'
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
			outputStyle: 'expanded'
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

// Watch for file changes
function watch() {
	gulp.watch( paths.elementorStyles.src, elementorStylesCompile );
	gulp.watch( paths.styles.src, sassCompile );
	gulp.watch( [ paths.js.src, paths.php.src ], browserSyncReload );
}


// define series of tasks
var server = gulp.series( browserSyncStart, watch );

exports.browserSyncStart = browserSyncStart;
exports.browserSyncReload = browserSyncReload;
exports.elementorStylesCompile = elementorStylesCompile;
exports.sassCompile = sassCompile;
exports.watch = watch;
exports.server = server;
