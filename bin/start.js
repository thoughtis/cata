/**
 * Start
 * Build + BrowserSync + File Reloading
 */

import browserSync from 'browser-sync';
import { watchJS, getJSExitPoints } from './modules/javascript.js';
import { watchLESS, getLESSExitPoints } from './modules/lesscss.js';
import browserSyncConfig from './browser-sync.js';

await watchJS();
await watchLESS();

const bsClient = browserSync.create();

bsClient.init( browserSyncConfig, onInit );

/**
 * On Init
 */
async function onInit() {
	bsClient
		.watch(
			[].concat(
				await getJSExitPoints(),
				await getLESSExitPoints()
			)
		)
		.on( "change", bsClient.reload );
}
