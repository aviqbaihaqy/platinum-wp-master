const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
const path = require("path");

// Rezolve Ziggy
mix.alias({
    ziggy: path.resolve("vendor/tightenco/ziggy/dist/vue"),
});

mix.extract({
    to: 'js/vendor-vue.js',
    libraries: /vue|vue-[a-z0-9-]+/
});
mix.extract();

// Build files
mix.js("resources/js/app.js", "public/js")
    .vue({ version: 2 })
    // .vue({ version: 3 })
    // .webpackConfig({
    //     resolve: {
    //         alias: {
    //             "@": path.resolve(__dirname, "resources/js"),
    //         },
    //     },
    // })
    // .extract()
    // .postCss("resources/css/app.css", "public/css", [require("tailwindcss")])
    .webpackConfig(require('./webpack.config'));

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
}
