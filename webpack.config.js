/**
 * @wordpress/scripts' own config (it finds src/notice/block.json and builds the block into
 * build/notice/), plus the admin panel entry.
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

const base = Array.isArray( defaultConfig ) ? defaultConfig[ 0 ] : defaultConfig;
const blockEntries = typeof base.entry === 'function' ? base.entry() : base.entry;

module.exports = {
	...base,
	entry: {
		...blockEntries,
		admin: './src/admin.tsx',
	},
};
