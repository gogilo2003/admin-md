<?php

namespace Ogilo\AdminMd\Console;

use Illuminate\Console\Command;
use Ogilo\AdminMd\Models\Hit;

use Storage;

class UpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post update command';

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
        $this->comment($res);

        $res = node_modules_install();
        $this->comment($res);
        
        $this->call('migrate');

        $path = public_path('vendor/admin');
        
        if (file_exists($path)) {
            try {
                deleteDirectory($path);
            } catch (Exception $e) {
                Command::error($e->getMessage());
            }
            
        }

        $this->call('vendor:publish', ['--tag'=>'public', '--force']);
        $this->call('vendor:publish', ['--tag'=>'md-public', '--force']);
        $this->call('vendor:publish', ['--tag'=>'chartjs', '--force']);
        $this->call('vendor:publish', ['--tag'=>'cropper', '--force']);

        clean_directories();

        /**
         * Update hits table
         * add browsers column and platforms column
        */
        $this->comment('Updating hits new columns');
        $hits = Hit::all();
        foreach ($hits as $key => $hit) {
            $hit->browser = getBrowser($hit->user_agent);
            $hit->platform = getOs($hit->user_agent);
            $hit->save();
        }
    }
}
