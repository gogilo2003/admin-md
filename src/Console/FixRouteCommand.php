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
    protected $signature = 'admin:fix_route';

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

        $path = base_path('routes/web.php');
        $subject = file_get_contents($path);

        $needle = "Route::get('/', function () {
    return view('welcome');
});";

        $replace = "// Route::get('/', function () {
//     return view('welcome');
// });";

        if (str_contains($subject, $needle)) {
            $subject = \Illuminate\Support\Str::replaceLast($needle, $replace, $subject);
            file_put_contents($path, $subject);
            $this->info('Welcome route commented');
        }

        $needle = "Route::get('admin/login', [Ogilo\AdminMd\Http\Controllers\AuthController::class, 'getLogin'])->name('login');";

        if (!str_contains($subject, $needle)) {
            $subject .= "\n" . $needle;
            file_put_contents($path, $subject);
            $this->info('Login route added');
        }
        $this->info('Route fixing complete');
    }
}
