/**
 * Gulpfile
 * 
 * @package Cata
 */

const autoprefixer = require( 'autoprefixer' );
const browserSync  = require( 'browser-sync' );
const cssnano      = require( 'cssnano' );
const gulp         = require( 'gulp' );
const less         = require( 'gulp-less' );
const lessGlob     = require( 'less-plugin-glob' );
const path         = require( 'path' );
const postcss      = require( 'gulp-postcss' );
const postcssClean = require( 'postcss-clean' );

/**
 * Task: LESS
 */
function taskLess( done ) {

	const lessOptions = {
		paths: [ path.resolve( __dirname, 'assets/src/less' ) ],
		plugins: [ lessGlob ]
	};

	const postcssCleanOptions = {
		level: 2,
		keepSpecialComments: 0
	};

	const postcssPlugins = [
		postcssClean( postcssCleanOptions ),
		autoprefixer(),
		cssnano( { safe: true } )
	];

	gulp
		.src( './assets/src/less/*.less' )
		.pipe( less( lessOptions ) )
		.pipe( postcss( postcssPlugins ) )
		.pipe( gulp.dest( './assets/dist/css' ) )
		.pipe( browserSync.stream() );

	done();

}
gulp.task( 'less', taskLess );

/**
 * Task: Less Watch
 */
function taskLessWatch( done ) {
	gulp.watch( './assets/src/less/**/*.less', gulp.series( 'less' ) );
	done();
}
gulp.task( 'lessWatch', taskLessWatch )

/**
 * Task: BrowserSync
 * Sync with browser
 * The host will be wrapped with a proxy URL http://localhost:3000/
 * 
 * @param function done
 */
function taskBrowserSync( done ) {

	var options = {
		proxy: 'dev.test',
		open: false
	};

	browserSync.init( options );

	done();

}
gulp.task( 'browserSync', taskBrowserSync );

/**
 * Default
 */
gulp.task( 'default', gulp.parallel( 'browserSync', 'less', 'lessWatch' ) );
