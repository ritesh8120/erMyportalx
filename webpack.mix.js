const mix = require("laravel-mix");
const path = require("path");
const { exec } = require("child_process");

mix.alias({
    ziggy: path.resolve("vendor/tightenco/ziggy/dist"),
});

mix.extend(
    "ziggy",
    new (class {
        register(config = {}) {
            this.watch = config.watch ?? ["routes/*.php"];
            this.path = config.path ?? "";
            this.enabled = true; //config.enabled ?? !Mix.inProduction();
        }

        boot() {
            if (!this.enabled) return;

            const command = () =>
                exec(
                    `php artisan ziggy:generate ${this.path}`,
                    (error, stdout, stderr) => console.log(stdout)
                );

            command();

            if (Mix.isWatching() && this.watch) {
                require("chokidar")
                    .watch(this.watch, { usePolling: true })
                    .on("all", (path) => {
                        console.log(`${path} changed...`);
                        command();
                    });
            }
        }
    })()
);
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

// mix.js("resources/js/app.js", "public/assets/js")
//     .ziggy();
mix.copyDirectory("resources/images", "public/assets/images");
mix.copyDirectory("resources/fonts", "public/assets/fonts");
mix.copyDirectory("resources/css", "public/assets/css");
mix.copyDirectory("resources/scss", "public/assets/scss");
mix.copyDirectory("resources/js/tamplate", "public/assets/js/tamplate");

// mix.styles(
//     ["resources/css/select2.min.css"],
//     "public/assets/css/select2.min.css"
// );
// mix.sass(
//     "resources/scss/admin/admin.scss",
//     "public/assets/css/admin/admin.css"
// ).options({
//     processCssUrls: false,
// });

mix.js(
    ["resources/js/login.js"],
    "public/assets/js/login.js"
).js(
    ["resources/js/employee/create.js"],
    "public/assets/js/employee/create.js"
).js(
    ["resources/js/admin/task/index.js"],
    "public/assets/js/admin/task/index.js"
).js(
    ["resources/js/admin/task/addEdit.js"],
    "public/assets/js/admin/task/addEdit.js"
).js(
    ["resources/js/timelog/create.js"],
    "public/assets/js/timelog/create.js"
).js(
    ["resources/js/timelog/index.js"],
    "public/assets/js/timelog/index.js"
).js(
    ["resources/js/bootstrap.js"],
    "public/assets/js/bootstrap.js"
).js(
    ['resources/js/employee/index.js'],
    'public/assets/js/employee/index.js'
);

mix.scripts(
    [
        "resources/js/jquery.min.js",
        "resources/js/nioapp.min.js",
        "resources/js/jquery.dataTables.min.js",
        "resources/js/dataTables.bootstrap4.min.js",
        "resources/js/toastr.min.js",
        "resources/js/common.js",
        "resources/js/jsvalidation.js",
    ],
    "public/assets/js/app.js"
);

mix.version();
