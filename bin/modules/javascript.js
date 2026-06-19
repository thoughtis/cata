/**
 * JavaScript Build Processes
 */

import { build, context } from 'esbuild';
import eslint from 'esbuild-plugin-eslint';
import fastglob from 'fast-glob';

/**
 * Entry Points
 */
export async function getJSEntryPoints() {
	return await fastglob(
		[
			'./assets/src/js/*.js'
		],
		{
			dot: false
		}
	);
}

/**
 * Exit Points
 */
export async function getJSExitPoints() {
	return (await getJSEntryPoints()).map( (entry) => {
		return entry.replace('/src/','/dist/');
	});
}

/**
 * Get Build Options
 */
async function getJSBuildOptions() {
	return {
		entryPoints: await getJSEntryPoints(),
		bundle: true,
		format: 'iife',
		minify: true,
		outdir: './assets/dist/js/',
		platform: 'browser',
		plugins: [
			eslint()
		],
		target: [
			'es2020'
		]
	};
}

/**
 * Build
 */
export async function buildJS() {
	build( await getJSBuildOptions() )
		.then(() => console.log('Built JavaScript'))
		.catch(() => process.exit(1));
}

/**
 * Watch
 */
export async function watchJS() {
	await(
		await context(
			await getJSBuildOptions()
		)
	).watch();
	console.log('Watching JavaScript');
}
