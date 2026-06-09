<?php

namespace Ogilo\AdminMd\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AdminFixCommand extends Command
{
    protected $signature = 'admin:fix
                            {--a|auth-config : Fix all (route, exception, and auth config)}
                            {--e|exception : Fix exception handler only}
                            {--r|route : Fix web route only}';

    protected $description = 'Fix admin authentication configuration';

    public function handle()
    {
        $fixAuth = $this->option('auth-config');
        $fixException = $this->option('exception');
        $fixRoute = $this->option('route');

        if (!$fixAuth && !$fixException && !$fixRoute) {
            $this->error('You must specify one of --auth-config, --exception, or --route options.');
            return;
        }

        if ($fixAuth) {
            $this->fixException();
            $this->fixRoute();
            $this->fixAuthConfig();
        } elseif ($fixException) {
            $this->fixException();
        } elseif ($fixRoute) {
            $this->fixRoute();
        }

        $this->info('Done');
    }

    protected function fixAuthConfig(): void
    {
        $version = $this->getLaravelMajorVersion();

        $stub = $this->resolveStub('auth', $version);
        if ($stub === null) {
            $stub = $this->resolveStub('auth', $version - 1);
        }

        if ($stub === null) {
            $this->error("No auth stub available for Laravel {$version}.");
            $this->line("Please configure auth.php manually. Refer to the documentation.");
            return;
        }

        $dest        = config_path('auth.php');
        $stubContent = File::get($stub);

        // =========================================================
        // FILE DOES NOT EXIST — fresh install or Laravel 11+
        // =========================================================
        if (!File::exists($dest)) {
            $this->writeAuthConfig($dest, $stubContent, $version);
            return;
        }

        $existingContent = File::get($dest);

        // =========================================================
        // ALREADY PATCHED — nothing to do
        // =========================================================
        if ($this->isAlreadyPatched($existingContent, 'auth')) {
            $this->info('auth.php is already configured. Skipping.');
            return;
        }

        // =========================================================
        // MATCHES ORIGINAL LARAVEL STUB — safe to replace silently
        // =========================================================
        $originalStub = $this->resolveOriginalStub('auth', $version);

        if ($originalStub !== null) {
            $originalContent = File::get($originalStub);

            if ($this->contentsMatch($existingContent, $originalContent)) {
                $this->writeAuthConfig($dest, $stubContent, $version);
                return;
            }
        }

        // =========================================================
        // FILE HAS BEEN MANUALLY MODIFIED — warn and confirm
        // =========================================================
        $this->warn('auth.php appears to have been manually modified.');
        $this->warn('Replacing it will overwrite your changes.');
        $this->line('');

        $writeLabel  = 'Replace auth.php with the package stub (your changes will be lost)';
        $backupLabel = 'Back up existing auth.php and replace with package stub';
        $cancelLabel = 'Cancel — I will update auth.php manually';

        $choice = $this->choice(
            'How would you like to proceed?',
            [$writeLabel, $backupLabel, $cancelLabel],
            $backupLabel
        );

        match ($choice) {
            $writeLabel  => $this->writeAuthConfig($dest, $stubContent, $version),
            $backupLabel => $this->backupAndWrite($dest, $stubContent, $existingContent, $version),
            $cancelLabel => $this->printManualInstructions($version),
        };
    }

    protected function resolveStub(string $type, int $version): ?string
    {
        $paths = [
            'auth' => package_path("stubs/auth/v{$version}.php"),
            'route' => package_path("stubs/routes/web/v{$version}.php"),
            'exception' => package_path("stubs/Handler/v{$version}.php"),
        ];

        $path = $paths[$type] ?? null;

        return $path && File::exists($path) ? $path : null;
    }

    protected function resolveOriginalStub(string $type, int $version): ?string
    {
        $paths = [
            'auth' => package_path("stubs/auth/originals/v{$version}.php"),
            'route' => package_path("stubs/routes/web/originals/v{$version}.php"),
            'exception' => package_path("stubs/Handler/originals/v{$version}.php"),
        ];

        $path = $paths[$type] ?? null;

        return $path && File::exists($path) ? $path : null;
    }

    protected function isAlreadyPatched(string $content, string $type = 'auth'): bool
    {
        return match ($type) {
            'auth' => str_contains($content, "'admins' =>")
                && str_contains($content, 'Ogilo\\AdminMd\\Models\\Admin'),
            'exception' => preg_match('/function\s+unauthenticated/', $content) === 1,
            'route' => str_contains($content, "admin/login"),
            default => false,
        };
    }

    protected function contentsMatch(string $a, string $b): bool
    {
        $normalize = fn(string $s) => preg_replace('/\s+/', ' ', trim($s));

        return $normalize($a) === $normalize($b);
    }

    protected function writeAuthConfig(string $dest, string $content, int $version): void
    {
        File::ensureDirectoryExists(dirname($dest));
        File::put($dest, $content);
        $this->info("auth.php configured successfully for Laravel {$version}.");
    }

    protected function backupAndWrite(
        string $dest,
        string $newContent,
        string $existingContent,
        int $version
    ): void {
        $backup = $dest . '.bak.' . now()->format('YmdHis');
        File::put($backup, $existingContent);
        $this->info("Backup saved to: {$backup}");

        $this->writeAuthConfig($dest, $newContent, $version);
    }

    protected function printManualInstructions(int $version, string $type = 'auth'): void
    {
        $this->line('');

        match ($type) {
            'auth' => $this->printAuthManualInstructions($version),
            'route' => $this->printRouteManualInstructions($version),
            'exception' => $this->printExceptionManualInstructions($version),
            default => null,
        };
    }

    protected function printAuthManualInstructions(int $version): void
    {
        $this->line('Add the following to your <comment>config/auth.php</comment> manually:');
        $this->line('');
        $this->line('<comment>Guard:</comment>');
        $this->line("  'admin' => ['driver' => 'session', 'provider' => 'admins']");
        $this->line('');
        $this->line('<comment>Provider:</comment>');
        $this->line("  'admins' => ['driver' => 'eloquent', 'model' => \\Ogilo\\AdminMd\\Models\\Admin::class]");
        $this->line('');
        $this->line('<comment>Password Broker:</comment>');
        $this->line("  'admins' => ['provider' => 'admins', 'table' => 'password_reset_tokens', 'expire' => 60, 'throttle' => 60]");
        $this->line('');
        $this->line("Refer to <comment>stubs/auth/v{$version}.php</comment> in the package for the full example.");
    }

    protected function printRouteManualInstructions(int $version): void
    {
        $this->line('Add the following to your <comment>routes/web.php</comment> manually:');
        $this->line('');
        $this->line("Route::get('admin/login', [\\Ogilo\\AdminMd\\Http\\Controllers\\AuthController::class, 'getLogin'])->name('login');");
        $this->line('');
        $this->line('Or refer to <comment>stubs/routes/web/v' . $version . '.php</comment> in the package for the full example.');
    }

    protected function printExceptionManualInstructions(int $version): void
    {
        $this->line('Add the following method to your <comment>app/Exceptions/Handler.php</comment> manually:');
        $this->line('');
        $this->line('    protected function unauthenticated($request, \\Illuminate\\Auth\\AuthenticationException $exception)');
        $this->line('    {');
        $this->line('        if (is_admin_path()) {');
        $this->line("            return redirect()->guest('admin/login');");
        $this->line('        }');
        $this->line('');
        $this->line('        if ($request->expectsJson()) {');
        $this->line("            return response()->json(['error' => 'Unauthenticated.'], 401);");
        $this->line('        }');
        $this->line('');
        $this->line("        return redirect()->guest('login');");
        $this->line('    }');
        $this->line('');
        $this->line('Refer to <comment>stubs/Handler/v' . $version . '.php</comment> in the package for the full example.');
    }

    protected function fixException(): void
    {
        $version = $this->getLaravelMajorVersion();
        $path = app_path("Exceptions/Handler.php");

        if (!File::exists($path)) {
            $this->error('Exceptions/Handler.php does not exist.');
            return;
        }

        $subject = file_get_contents($path);

        if ($this->isAlreadyPatched($subject, 'exception')) {
            $this->info('Exception handler already fixed!');
            return;
        }

        $stub = $this->resolveStub('exception', $version);
        if ($stub === null) {
            $stub = $this->resolveStub('exception', $version - 1);
        }

        if ($stub === null) {
            $this->error("No exception stub available for Laravel {$version}.");
            $this->printManualInstructions($version, 'exception');
            return;
        }

        $stubContent = File::get($stub);

        $originalStub = $this->resolveOriginalStub('exception', $version);
        if ($originalStub === null) {
            $originalStub = $this->resolveOriginalStub('exception', $version - 1);
        }

        if ($originalStub && File::exists($originalStub) && $this->contentsMatch($subject, File::get($originalStub))) {
            File::put($path, $stubContent);
            $this->info('Handler replaced with package stub.');
            return;
        }

        $this->printManualInstructions($version, 'exception');
    }

    protected function fixRoute(): void
    {
        $version = $this->getLaravelMajorVersion();
        $path = base_path('routes/web.php');

        if (!File::exists($path)) {
            $this->error('routes/web.php does not exist.');
            return;
        }

        $subject = file_get_contents($path);

        if ($this->isAlreadyPatched($subject, 'route')) {
            $this->info('Login route already exists.');
            return;
        }

        $stub = $this->resolveStub('route', $version);
        if ($stub === null) {
            $stub = $this->resolveStub('route', $version - 1);
        }

        if ($stub === null) {
            $this->error("No route stub available for Laravel {$version}.");
            $this->printManualInstructions($version, 'route');
            return;
        }

        $stubContent = File::get($stub);

        $originalStub = $this->resolveOriginalStub('route', $version);
        if ($originalStub === null) {
            $originalStub = $this->resolveOriginalStub('route', $version - 1);
        }

        if ($originalStub && File::exists($originalStub) && $this->contentsMatch($subject, File::get($originalStub))) {
            File::put($path, $stubContent);
            $this->info('Route file replaced with package stub.');
            return;
        }

        $this->comment('Adding admin login route manually.');
        $subject .= "\n" . "Route::get('admin/login', [Ogilo\AdminMd\Http\Controllers\AuthController::class, 'getLogin'])->name('login');";
        file_put_contents($path, $subject);
        $this->info('Login route added');
    }

    protected function getLaravelMajorVersion(): int
    {
        return (int) \Illuminate\Foundation\Application::VERSION;
    }
}
