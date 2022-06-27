<?php

namespace Ogilo\AdminMd;

use Illuminate\Support\ServiceProvider;
use Ogilo\AdminMd\Console\GenerateSitemap;
use Ogilo\AdminMd\Console\InstallCommand;
use Ogilo\AdminMd\Console\MakePageCommand;
use Ogilo\AdminMd\Console\UpdateCommand;

/**
 *
 */
class AdminServiceProvider extends ServiceProvider
{
    function register()
    {

        // print(config('app.name').' in register()');
        $this->app->bind('admin', function ($app) {
            return new Admin;
        });

        $file = __DIR__ . '/Support/helpers.php';
        if (file_exists($file)) {
            require_once $file;
        }

        $this->mergeConfigFrom(
            __DIR__ . '/../config/admin.php',
            'admin'
        );
    }

    public function boot()
    {

        if (config('admin.articles')) {
            config(['admin.menu.admin-articles' => 'Articles']);
        } else {
            config(['admin.menu.admin-articles' => null]);
        }

        if (config('admin.blogs')) {
            config(['admin.menu.admin-blogs' => 'Blogs']);
        } else {
            config(['admin.menu.admin-blogs' => null]);
        }

        if (config('admin.pictures')) {
            config(['admin.menu.admin-pictures' => 'Pictures']);
        } else {
            config(['admin.menu.admin-pictures' => null]);
        }
        if (config('admin.videos')) {
            config(['admin.menu.admin-videos' => 'Videos']);
        } else {
            config(['admin.menu.admin-videos' => null]);
        }

        if (config('admin.files')) {
            config(['admin.menu.admin-files' => 'Files']);
        } else {
            config(['admin.menu.admin-files' => null]);
        }

        if (config('admin.projects')) {
            config(['admin.menu.admin-projects' => 'Projects']);
        } else {
            config(['admin.menu.admin-projects' => null]);
        }

        if (config('admin.profiles')) {
            config(['admin.menu.admin-profiles' => 'Profiles']);
        } else {
            config(['admin.menu.admin-profiles' => null]);
        }

        if (config('admin.sermons')) {
            config(['admin.menu.admin-sermons' => 'Sermons']);
        } else {
            config(['admin.menu.admin-sermons' => null]);
        }

        if (config('admin.events')) {
            config(['admin.menu.admin-events' => 'Events']);
        } else {
            config(['admin.menu.admin-events' => null]);
        }

        if (config('admin.products')) {
            config(['admin.menu.admin-products' => 'Products']);
        } else {
            config(['admin.menu.admin-products' => null]);
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                UpdateCommand::class,
            ]);
        }

        $this->commands([
            MakePageCommand::class,
            GenerateSitemap::class,
        ]);

        $this->loadRoutesFrom(__DIR__ . '/../routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/hits.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // $this->publishes([
        // 	__DIR__.'/../database/migrations' => database_path('migrations'),
        // ], 'admin-migrations');

        $this->publishes([
            __DIR__ . '/../public/css' => public_path('vendor/admin/css'),
            __DIR__ . '/../public/img' => public_path('vendor/admin/img'),
            __DIR__ . '/../public/js' => public_path('vendor/admin/js'),
            __DIR__ . '/../fonts' => public_path('fonts'),
            __DIR__ . '/../images' => public_path('images'),
            __DIR__ . '/../public/images' => public_path('vendor/admin/images'),
            __DIR__ . '/../resources/assets/material-dashboard-master/assets/img' => public_path('vendor/admin/material-dashboard-master/assets/img'),
            __DIR__ . '/../resources/assets/material-dashboard-master/assets/css' => public_path('vendor/admin/material-dashboard-master/assets/css'),
            __DIR__ . '/../resources/assets/material-dashboard-master/assets/js' => public_path('vendor/admin/material-dashboard-master/assets/js'),
        ], 'admin-assets');

        $this->publishes([
            __DIR__ . '/../config/admin.php' => config_path('admin.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__ . '/../public/stopwords.txt' => public_path('stopwords.txt'),
        ], 'stopwords');

        // $this->publishes([
        // 	__DIR__ . '/../resources/assets/js' => resource_path('assets/vendor/admin/js'),
        // 	__DIR__ . '/../resources/assets/scss' => resource_path('assets/vendor/admin/scss'),
        // ], 'vue-resources');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/admin'),
        ], 'admin-views');

        $this->publishes([
            __DIR__ . '/../stubs' => base_path('stubs'),
        ], 'admin-stubs');

        $this->publishes([
            __DIR__ . '/../resources/views/web/inc' => resource_path('views/vendor/admin/web/inc'),
            __DIR__ . '/../resources/views/web/layout' => resource_path('views/vendor/admin/web/layout'),
        ], 'web-layout');

        $this->publishes([
            __DIR__ . '/../resources/views/web/article.blade.php' => resource_path('views/web/article.blade.php'),
            __DIR__ . '/../resources/views/web/blogs.blade.php' => resource_path('views/web/blogs.blade.php'),
            __DIR__ . '/../resources/views/web/contact.blade.php' => resource_path('views/web/contact.blade.php'),
            __DIR__ . '/../resources/views/web/event.blade.php' => resource_path('views/web/event.blade.php'),
            __DIR__ . '/../resources/views/web/file.blade.php' => resource_path('views/web/file.blade.php'),
            __DIR__ . '/../resources/views/web/files.blade.php' => resource_path('views/web/files.blade.php'),
            __DIR__ . '/../resources/views/web/home.blade.php' => resource_path('views/web/home.blade.php'),
            __DIR__ . '/../resources/views/web/profile.blade.php' => resource_path('views/web/profile.blade.php'),
            __DIR__ . '/../resources/views/web/projects.blade.php' => resource_path('views/web/projects.blade.php'),
            __DIR__ . '/../resources/views/web/sermons.blade.php' => resource_path('views/web/sermons.blade.php'),
            __DIR__ . '/../resources/views/web/sermon.blade.php' => resource_path('views/web/sermon.blade.php'),
            __DIR__ . '/../resources/views/web/gallery.blade.php' => resource_path('views/web/gallery.blade.php'),
        ], 'web-views');
    }
}
