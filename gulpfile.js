'use strict';

var gulp         = require( 'gulp' );
var browserSync  = require( 'browser-sync' ).create();
var sass         = require( 'gulp-sass' );
var postcss      = require( 'gulp-postcss' );
var autoprefixer = require( 'autoprefixer' );
var rename       = require( 'gulp-rename' );
var rtlcss       = require( 'gulp-rtlcss' );
var lec          = require( 'gulp-line-ending-corrector' );

// Define paths
var paths = {
	js              : {
		src  : './js/*.js',
		dest : './js/'
	},
	elementorStyles : {
		src  : './inc/elementor/assets/SCSS/**/*.scss',
		dest : './inc/elementor/assets/css/'
	},
	styles          : {
		src  : './assets/scss/**/*.scss',
		dest : './'
	},
	php             : {
		src : [ './*.php', './post-templates/*.php' ]
	},
	rtlcss          : {
		style : {
			src  : [ './style.css' ],
			dest : './'
		}
	}
};

// Start browserSync
function browserSyncStart( cb ) {
	browserSync.init( {
		proxy : 'spacious.local'
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
			indentType  : 'tab',
			indentWidth : 1,
			outputStyle : 'expanded',
			linefeed    : 'crlf'
		} ).on( 'error', sass.logError ) )
		.pipe( postcss( [
			autoprefixer( {
				browsers : [ 'last 2 versions' ],
				cascade  : false
			} )
		] ) )
		.pipe( gulp.dest( paths.elementorStyles.dest ) )
		.pipe( browserSync.stream() );
}


function sassCompile() {
	return gulp.src( paths.styles.src )
		.pipe( sass( {
			indentType  : 'tab',
			indentWidth : 1,
			outputStyle : 'expanded',
			linefeed    : 'crlf'
		} ).on( 'error', sass.logError ) )
		.pipe( postcss( [
			autoprefixer( {
				browsers : [ 'last 2 versions' ],
				cascade  : false
			} )
		] ) )
		.pipe( gulp.dest( paths.styles.dest ) )
		.pipe( browserSync.stream() );
}

// Generates RTL CSS file.
function generateRTLCSS() {
	return gulp
		.src( paths.rtlcss.style.src )
		.pipe( rtlcss() )
		.pipe( rename( { suffix : '-rtl' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.rtlcss.style.dest ) );
}

// Watch for file changes
function watch() {
	gulp.watch( paths.elementorStyles.src, elementorStylesCompile );
	gulp.watch( paths.styles.src, sassCompile );
	// gulp.watch( [ paths.js.src, paths.php.src ], browserSyncReload );
	gulp.watch( paths.rtlcss.style.src, generateRTLCSS );
}


// define series of tasks
var server = gulp.series( browserSyncStart, watch, generateRTLCSS );

exports.browserSyncStart       = browserSyncStart;
exports.browserSyncReload      = browserSyncReload;
exports.elementorStylesCompile = elementorStylesCompile;
exports.sassCompile            = sassCompile;
exports.watch                  = watch;
exports.server                 = server;
exports.generateRTLCSS         = generateRTLCSS;
