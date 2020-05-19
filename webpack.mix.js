const mix = require('laravel-mix');

const postcssImport = require('postcss-import');

const postcssNested = require('postcss-nested');

const autoprefixer = require('autoprefixer');

const tailwindcss = require('tailwindcss');

let postCSSPlugins = [
    postcssImport,
    tailwindcss,
    postcssNested,
    autoprefixer
];

if (mix.inProduction()) {

    mix.version();
}

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', postCSSPlugins)
    .browserSync({
        proxy: 'http://127.0.0.1:8000'
    })
    .options({
        terser: {
          extractComments: false,
        }
    });
