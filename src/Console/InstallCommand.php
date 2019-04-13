<?php

namespace Ogilo\Admin\Console;

use Illuminate\Console\Command;

use Ogilo\Admin\Support\AdminConfig;

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
        $res = bower_install();
        $this->comment(var_export($res,TRUE));
        $this->call('migrate');
        $this->call('vendor:publish', ['--tag'=>'public', '--force']);

    }
}
