/**
 * Build
 */

import { buildJS } from "./modules/javascript.js";
import { buildLESS } from "./modules/lesscss.js";

await buildJS();
await buildLESS();
