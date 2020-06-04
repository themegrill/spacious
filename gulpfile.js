'use strict';

var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');

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
        src: ['./*.php', './post-templates/*.php']
    },
    gbscss: {
        src: ['./assets/scss/style-editor-block.scss'],
        dest: './'
    },

};

// Start browserSync
function browserSyncStart(cb) {
    browserSync.init({
        proxy: 'spacious.local'
    }, cb);
}

// Reloads the browser
function browserSyncReload(cb) {
    browserSync.reload();
    cb();
}

function elementorStylesCompile() {
    return gulp.src(paths.elementorStyles.src)
        .pipe(sass({
            indentType: 'tab',
            indentWidth: 1,
            outputStyle: 'expanded',
            linefeed: 'crlf'
        }).on('error', sass.logError))
        .pipe(postcss([
            autoprefixer({
                browsers: ['last 2 versions'],
                cascade: false
            })
        ]))
        .pipe(gulp.dest(paths.elementorStyles.dest))
        .pipe(browserSync.stream());
}


function sassCompile() {
    return gulp.src(paths.styles.src)
        .pipe(sass({
            indentType: 'tab',
            indentWidth: 1,
            outputStyle: 'expanded',
            linefeed: 'crlf'
        }).on('error', sass.logError))
        .pipe(postcss([
            autoprefixer({
                browsers: ['last 2 versions'],
                cascade: false
            })
        ]))
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(browserSync.stream());
}
// Compiles Gutenberg SCSS into CSS.
function compilegbsass() {
    return gulp
        .src(paths.gbscss.src)
        .pipe(
            sass({
                indentType: 'tab',
                indentWidth: 1,
                outputStyle: 'expanded'
            })
        )
        .pipe(lec({ verbose: true, eolc: 'LF', encoding: 'utf8' }))
        .pipe(gulp.dest(paths.gbscss.dest))
        .pipe(browserSync.stream())
        .on('error', notify.onError());
}



// Watch for file changes
function watch() {
    gulp.watch(paths.elementorStyles.src, elementorStylesCompile);
    gulp.watch(paths.styles.src, sassCompile);
    gulp.watch(paths.js.src, browserSyncReload);
    gulp.watch(paths.php.src, browserSyncReload);
}


// define series of tasks
var server = gulp.series(browserSyncStart, watch);

exports.browserSyncStart = browserSyncStart;
exports.browserSyncReload = browserSyncReload;
exports.elementorStylesCompile = elementorStylesCompile;
exports.sassCompile = sassCompile;
exports.compilegbsass = compilegbsass;
exports.watch = watch;
exports.server = server;