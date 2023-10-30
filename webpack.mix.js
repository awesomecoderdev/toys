const mix = require("laravel-mix");
const path = require("node:path");
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
	// stats: {
	// 	children: false,
	// },
	resolve: {
		alias: {
			"@/components": path.resolve(__dirname, "./src/components"),
			"@/lib": path.resolve(__dirname, "./src/lib"),
		},
	},
})
	.js("src/backend.js", "admin/js")
	// .js("src/backend/js/metabox.js", "backend/js")
	.postCss("src/backend.css", "admin/css", [
		require("postcss-import"),
		require("tailwindcss"),
		require("autoprefixer"),
	])
	// .postCss("src/backend.css", "public/css/toys-public.css", [
	// 	require("postcss-import"),
	// 	require("tailwindcss"),
	// 	require("autoprefixer"),
	// ])
	// .postCss("src/frontend/css/frontend.css", "frontend/css", [
	//   require("postcss-import"),
	//   require("tailwindcss"),
	//   require("autoprefixer"),
	// ])
	// .js("src/frontend/js/frontend.js", "frontend/js")
	.react()
	.sourceMaps(false, "source-map")
	.disableSuccessNotifications();
