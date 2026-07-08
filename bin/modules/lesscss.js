/**
 * LESS CSS Build Processes
 */

import { build } from 'esbuild';
import fastglob from 'fast-glob';
import { lessLoader } from 'esbuild-plugin-less';
import lessPluginGlob from 'less-plugin-glob';
import chokidar from 'chokidar';

/**
 * Get LESS Entry Points
 *
 * @return {Array}
 */
export async function getLESSEntryPoints() {
	return await fastglob(
		[
			'./assets/src/less/*.less'
		],
		{
			dot: false
		}
	);
}

/**
 * Get LESS Exit Points
 *
 * @return {Array}
 */
export async function getLESSExitPoints() {
	return (await getLESSEntryPoints()).map( (entry) => {
		return entry.replace( '/src/less/', '/dist/css/' ).replace( '.less', '.css' );
	});
}

/**
 * Build LESS
 */
export async function buildLESS() {
	build({
		bundle: true,
		entryPoints: await getLESSEntryPoints(),
		minify: true,
		outdir: './assets/dist/css/',
		platform: 'browser',
		plugins: [
			lessLoader({
				plugins: [ lessPluginGlob ]
			})
		],
		target: [
			'edge109',
			'chrome109',
			'safari16.3',
			'ios16.3',
			'firefox109'
		]
	})
	.then(() => console.log( 'Built LESS' ))
	.catch(() => process.exit(1));
}

/**
 * Watch LESS
 */
export function watchLESS() {
	chokidar.watch( './assets/src/less/' ).on( 'change', buildLESS );
	console.log( 'Watching LESS' );
}
