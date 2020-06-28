<?php

namespace Ogilo\AdminMd\Console;

use Illuminate\Console\Command;
use Ogilo\AdminMd\Models\Hit;
use Illuminate\View\Engines\PhpEngine;

use File;

class MakePageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-page
                            {name : Name of the template}
                            {--m|meta : Add meta information section for the page}
                            {--b|scripts-bottom : Add push section for bottom scripts}
                            {--t|scripts-top : Add push section for top scripts}
                            {--s|styles : Add push section for styles}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Page template command';

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
        $phpEngine = app()->make(PhpEngine::class);
        $newFileContent = "";
        $filePath = stub_path('page.blade.php.tpl');

        $name = $this->argument('name');
        $scriptsTop = $this->option('scripts-top') ? true : false;
        $scriptsBottom = $this->option('scripts-bottom') ? true : false;
        $styles = $this->option('styles') ? true : false;

        $destPath = resource_path("views/web/");
        if(!file_exists($destPath)){
            mkdir($destPath,0755, TRUE);
        }
        $destPath = resource_path("views/web/$name.blade.php");

        try {
            $newFileContent = $phpEngine->get($filePath,compact('name','scriptsBottom','scriptsTop','styles'));
            \file_put_contents($destPath,$newFileContent);
        } catch (Exception $e) {
            $this->error("Template [$filePath] contains syntax errors");
            $this->error($e->getMessage());
        }

        // $this->comment($newFileContent);
        $this->comment("\n");
    }
}
