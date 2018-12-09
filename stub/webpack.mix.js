let AfterWebpack = require('on-build-webpack')
let Watch = require('webpack-watch')
let command = require('node-cmd')
let { mix } = require('laravel-mix')
let fs = require('fs')

let bin = './vendor/bin/groot'

if (! fs.existsSync(bin)) {
    bin = 'groot'
}

mix.webpackConfig({
    plugins: [
        new AfterWebpack(() => {
            command.get(`${bin} build`, (error, stdout, stderr) => {
                console.log(error ? stderr : stdout);
            });
        }),

        new Watch({
            options: { ignoreInitial: true },
            paths: ['app/**/*.twig'],
        })
    ]
})

mix
    .setPublicPath('markup')
    .postCss('assets/css/app.css', 'css', [
        require('postcss-import'),
        require('postcss-nested'),
        require('tailwindcss')('./assets/tailwind.js'),
    ])
    .options({
        processCssUrls: false,
    })
    .js('assets/js/app.js', 'js')
    .extract(['vue'])
