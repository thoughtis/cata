/**
 * Gulpfile
 * 
 * @package Cata
 */

const autoprefixer = require( 'autoprefixer' );
const browserSync  = require( 'browser-sync' );
const eslint       = require( 'gulp-eslint' );
const gulp         = require( 'gulp' );
const less         = require( 'gulp-less' );
const lessGlob     = require( 'less-plugin-glob' );
const path         = require( 'path' );
const postcss      = require( 'gulp-postcss' );
const rollup       = require( 'gulp-better-rollup' );
const rollupBabel  = require( '@rollup/plugin-babel' );
const cssByeBye    = require( 'css-byebye' );
const concat       = require( 'gulp-concat' );
const CleanCSS     = require( 'clean-css' );

/**
 * Task: LESS
 * 
 * @param {function} done
 */
function taskLess( done ) {

	const lessOptions = {
		paths: [ path.resolve( __dirname, 'assets/src/less' ) ],
		plugins: [ lessGlob ]
	};

	const cssCleanOptions = {
		level: 2,
		specialComments: 0
	};

	const postcssPlugins = [
		autoprefixer(),
		cssByeBye({
			rulesToRemove: [
				'[type=button]::-moz-focus-inner',
				'[type=reset]::-moz-focus-inner',
				'[type=submit]::-moz-focus-inner',
				'button::-moz-focus-inner',
				'button:-moz-focusring',
				'[type=button]:-moz-focusring',
				'[type=reset]:-moz-focusring',
				'[type=submit]:-moz-focusring',
				'[type=search]'
			]
		})
	];

	gulp
		.src( './assets/src/less/*.less' )
		.pipe( less( lessOptions ) )
		.on('data', function(file) {
            const buferFile = new CleanCSS(cssCleanOptions).minify(file.contents)
            return file.contents = Buffer.from(buferFile.styles)
        })
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
 * @param {function} done
 */
function taskBrowserSync( done ) {

	var options = {
		proxy: 'dev.local',
		open: false
	};

	browserSync.init( options );

	done();

}
gulp.task( 'browserSync', taskBrowserSync );

/**
 * Task Scripts
 * 
 * @param {function} done 
 */
async function taskScripts( done ) {

	const inputSettings = {
		plugins: [
			rollupBabel.babel()
		]
	};

	const outputSettings = {
		format: 'iife'
	};

	gulp
		.src( './assets/src/js/*.js' )
		.pipe( rollup( inputSettings, outputSettings ) )
		.pipe( gulp.dest( './assets/dist/js/' ) );

	done();

}
gulp.task( 'scripts', taskScripts );

/**
 * Task Scripts Watch
 * 
 * @param {function} done 
 */
function taskScriptsWatch( done ) {

	gulp
		.watch( './assets/src/js/**/*.js', gulp.series( 'scripts' ) )
		.on( 'change', scriptsOnChange );

	done();

}
gulp.task( 'scriptsWatch', taskScriptsWatch );

/**
 * On Change
 * 
 * @param {string} pathToChangedFile 
 */
function scriptsOnChange( pathToChangedFile ) {

	// ESLint
	gulp
		.src( pathToChangedFile )
		.pipe( eslint() )
		.pipe( eslint.formatEach( 'table', process.stderr ) );

}

/**
 * Default
 */
gulp.task( 'default', gulp.series( 'browserSync', 'less', 'lessWatch', 'scripts', 'scriptsWatch' ) );