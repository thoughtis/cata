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
const postcssClean = require( 'postcss-clean' );
const rollup       = require( 'gulp-better-rollup' );
const rollupBabel  = require( '@rollup/plugin-babel' );
const cssByeBye    = require( 'css-byebye' );
const concat       = require( 'gulp-concat' );

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

	const postcssCleanOptions = {
		level: 2,
		keepSpecialComments: 0
	};

	const postcssPlugins = [
		postcssClean( postcssCleanOptions ),
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
		.pipe( postcss( postcssPlugins ) )
		.pipe( gulp.dest( './assets/dist/css' ) )
		.pipe( browserSync.stream() );

	done();

}
gulp.task( 'less', taskLess );

/**
 * WordPress
 * Make a CSS file for the blocks we haven't implemented in Cata yet.
 * 
 * @param {function} done
 */
function taskWordPress( done ) {

	const files = [
		'cover/style',
		'latest-comments/style',
		'latest-posts/style',
		'navigation/style',
		'navigation-link/style',
		'page-list/style',
		'post-author/style',
		'post-comments/style',
		'post-excerpt/style',
		'post-featured-image/style',
		'post-template/style',
		'post-terms/style',
		'post-title/style',
		'query-pagination/style',
		'rss/style',
		'search/style',
		'search/theme',
		'site-logo/style',
		'social-links/style',
		'spacer/style',
		'tag-cloud/style',
		'text-columns/style'
	];

	const paths = files.map( ( file ) => {
		return `../../../wp-includes/blocks/${file}.min.css`
	} );

	gulp
		.src( paths )
		.pipe( concat( 'wp-block-library.css' ) )
		.pipe( gulp.dest( './assets/dist/css' ))

	done();
}
gulp.task( 'wordpress', taskWordPress );

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
