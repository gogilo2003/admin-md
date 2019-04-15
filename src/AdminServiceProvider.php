<?php

namespace Ogilo\AdminMd;

use Illuminate\Support\ServiceProvider;
use Ogilo\AdminMd\Console\InstallCommand;
use Ogilo\AdminMd\Console\UpdateCommand;
/**
* 
*/
class AdminServiceProvider extends ServiceProvider
{

	protected $commands = [
		'Ogilo\AdminMd\Console\InstallComand'
	];

	function register()
	{
		// print(config('app.name').' in register()');
		$this->app->bind('admin',function($app){
			return new Admin;
		});
	}

	public function boot()
	{
		// dd(config('admin'));

		if(config('admin.articles')){
			config(['admin.menu.admin-articles'=>'Articles']);
		}else{
			config(['admin.menu.admin-articles'=>null]);
		}

		if(config('admin.pictures')){
			config(['admin.menu.admin-pictures'=>'Pictures']);
		}else{
			config(['admin.menu.admin-pictures'=>null]);
		}
		if(config('admin.videos')){
			config(['admin.menu.admin-videos'=>'Videos']);
		}else{
			config(['admin.menu.admin-videos'=>null]);
		}

		if(config('admin.files')){
			config(['admin.menu.admin-files'=>'Files']);
		}else{
			config(['admin.menu.admin-files'=>null]);
		}

		if(config('admin.projects')){
			config(['admin.menu.admin-projects'=>'Projects']);
		}else{
			config(['admin.menu.admin-projects'=>null]);
		}

		if(config('admin.profiles')){
			config(['admin.menu.admin-profiles'=>'Profiles']);
		}else{
			config(['admin.menu.admin-profiles'=>null]);
		}

		if(config('admin.sermons')){
			config(['admin.menu.admin-sermons'=>'Sermons']);
		}else{
			config(['admin.menu.admin-sermons'=>null]);
		}

		if(config('admin.events')){
			config(['admin.menu.admin-events'=>'Events']);
		}else{
			config(['admin.menu.admin-events'=>null]);
		}

		if(config('admin.packages')){
			config(['admin.menu.admin-packages'=>'Packages']);
		}else{
			config(['admin.menu.admin-packages'=>null]);
		}

		if(config('admin.search',false)){
			config(['admin.menu.admin-packages-search'=>'Search']);
		}else{
			config(['admin.menu.admin-packages-search'=>null]);
		}

		if ($this->app->runningInConsole()) {
			$this->commands([
					InstallCommand::class,
					UpdateCommand::class
				]);
		}
		// print(config('app.name').' in boot()');
		require_once(__DIR__.'/Support/helpers.php');

		$this->loadRoutesFrom(__DIR__.'/routes/admin.php');
		$this->loadRoutesFrom(__DIR__.'/routes/web.php');
		$this->loadRoutesFrom(__DIR__.'/routes/hits.php');
		$this->loadViewsFrom(__DIR__.'/../resources/views','admin');
		$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
		// $this->loadSeedsFrom(__DIR__.'/../database/seeds');

		$this->publishes([
			__DIR__.'/../database/seeds' => database_path('seeds/vendor/admin'),
		], 'database');

		$this->publishes([

			__DIR__.'/../public/css' => public_path('vendor/admin/css'),
			__DIR__.'/../public/iconmoon' => public_path('vendor/admin/iconmoon'),
			__DIR__.'/../public/bower_components/bootstrap-select/dist/css' => public_path('vendor/admin/css'),
			__DIR__.'/../public/bower_components/datatables/media/css' => public_path('vendor/admin/css'),
			__DIR__.'/../public/bower_components/datatables/media/images' => public_path('vendor/admin/images'),
			__DIR__.'/../public/js' => public_path('vendor/admin/js'),
			// __DIR__.'/../public/bower_components/bootstrap/dist/fonts' => public_path('vendor/admin/fonts'),
			// __DIR__.'/../public/bower_components/font-awesome/fonts' => public_path('vendor/admin/fonts'),
			// __DIR__.'/../public/bower_components/jquery/dist' => public_path('vendor/admin/js'),
			// __DIR__.'/../public/bower_components/bootstrap/dist/js' => public_path('vendor/admin/js'),
			__DIR__.'/../public/bower_components/bootstrap-select/dist/js' => public_path('vendor/admin/js'),
			__DIR__.'/../public/bower_components/datatables/media/js' => public_path('vendor/admin/js'),
			__DIR__.'/../public/bower_components/tinymce/tinymce.min.js' => public_path('vendor/admin/js/tinymce.min.js'),
			__DIR__.'/../public/bower_components/tinymce/themes' => public_path('vendor/admin/js/themes'),
			__DIR__.'/../public/bower_components/tinymce/skins' => public_path('vendor/admin/js/skins'),
			__DIR__.'/../public/bower_components/tinymce/plugins' => public_path('vendor/admin/js/plugins'),
			__DIR__.'/../public/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js' => public_path('vendor/admin/js/bootstrap-notify.min.js'),
			__DIR__.'/../public/bower_components/bootstrap-file-input/bootstrap.file-input.js' => public_path('vendor/admin/js/bootstrap.file-input.js'),
			__DIR__.'/../public/bower_components/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js' => public_path('vendor/admin/js/bootstrap-hover-dropdown.min.js'),
			__DIR__.'/../public/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js' => public_path('vendor/admin/js/bootstrap-datetimepicker.min.js'),
			__DIR__.'/../public/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css' => public_path('vendor/admin/css/bootstrap-datetimepicker.min.css'),
			__DIR__.'/../public/bower_components/moment/min/moment.min.js' => public_path('vendor/admin/js/moment.min.js'),
			__DIR__.'/../public/bower_components/bootstrap3-typeahead/bootstrap3-typeahead.min.js' => public_path('vendor/admin/js/bootstrap3-typeahead.min.js'),
			// __DIR__.'/../public/bower_components/chart.js/dist/Chart.min.js' => public_path('vendor/admin/js/Chart.min.js'),

			__DIR__.'/../public/material-dashboard-master/node_modules/chart.js/dist/Chart.min.js'=>public_path('vendor/admin/material-dashboard-master/assets/js/plugins/Chart.min.js'),
			__DIR__.'/../public/material-dashboard-master/node_modules/chart.js/dist/Chart.min.css'=>public_path('vendor/admin/material-dashboard-master/assets/css/Chart.min.css'),
			__DIR__.'/../public/material-dashboard-master/assets'=>public_path('vendor/admin/material-dashboard-master/assets'),
		],'public');
		$this->publishes([__DIR__.'/../config/admin.php'=>config_path('admin.php')],'config');

	}
}