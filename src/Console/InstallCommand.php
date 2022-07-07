<?php

namespace Ogilo\AdminMd\Console;

use Illuminate\Console\Command;

use Ogilo\AdminMd\Support\AdminConfig;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post Install command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $res = bower_install();
        // $this->comment(var_export($res,TRUE));

        // $res = node_modules_install();
        // $this->comment(var_export($res,TRUE));

        $this->call('migrate');

        // $this->call('vendor:publish', ['--tag'=>'node_modules', '--force']);
        // $this->call('vendor:publish', ['--tag'=>'md-public', '--force']);
        $this->call('vendor:publish', ['--tag' => 'admin-assets', '--force']);
        // $this->call('vendor:publish', ['--tag'=>'vue-resources', '--force']);
        $this->call('vendor:publish', ['--tag' => 'stopwords', '--force']);

        // clean_directories();
        $this->call("admin:exception");
    }
}
