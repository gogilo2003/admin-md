<?php

namespace Ogilo\AdminMd\Console;

use Illuminate\Console\Command;

use Ogilo\AdminMd\Support\AdminConfig;

class FixRouteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix Web route';

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
        $replacement = <<<EOD

    /**
    * Convert an authentication exception into a response.
    *
    * @param  \Illuminate\Http\Request  \$request
    * @param  \Illuminate\Auth\AuthenticationException  \$exception
    * @return \Symfony\Component\HttpFoundation\Response
    */
    protected function unauthenticated(\$request, \Illuminate\Auth\AuthenticationException \$exception)
    {
        if (is_admin_path()) {
            return redirect()->guest('admin/login');
        }

        if (\$request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
EOD;
        $path = base_path('routes/web.php');
        $subject = file_get_contents($path);
        // $output_array = [];

        // preg_match('/function\ unauthenticated/', $subject, $output_array);

        // if (count($output_array)) {
        //     $this->info('Exeption handler already fixed!');
        // } else {
        //     $this->comment('Preparing to fix exception handler');
        //     $subject = preg_replace('/[\}]$/', $replacement, $subject);
        //     file_put_contents($path, $subject);
        //     $this->info('Exception handler fixed');
        // }

        $this->info($subject);
    }
}
