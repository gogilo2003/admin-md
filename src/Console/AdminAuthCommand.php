<?php

namespace Ogilo\AdminMd\Console;

use Illuminate\Console\Command;
use Ogilo\AdminMd\Services\AdminService;

class AdminAuthCommand extends Command
{
    protected $signature = 'admin:auth
                            {admin : The admin ID or email}
                            {--p|password= : The password for the admin}
                            {--n|name= : The name of the admin}
                            {--e|email= : The email of the admin}
                            {--create : Create a new admin user}';

    protected $description = 'Create or update an admin user';

    public function handle(AdminService $adminService)
    {
        $create = $this->option('create');
        $admin = $this->argument('admin');
        $email = $this->option('email');
        $name = $this->option('name');
        $password = $this->option('password');

        if ($create) {
            if (!$name || !$email) {
                $this->error('--name and --email are required when creating a new admin.');
                $this->error('Usage: php artisan admin:auth --create --name=John --email=john@example.com [--password=secret]');
                return 1;
            }

            return $this->createAdmin($adminService, $name, $email, $password);
        }

        if (!$admin) {
            $this->error('The admin parameter (ID or email) is required when updating.');
            $this->error('Usage: php artisan admin:auth <id|email> [--email=] [--name=] [--password=]');
            return 1;
        }

        return $this->updateAdmin($adminService, $admin, $email, $name, $password);
    }

    protected function createAdmin(AdminService $adminService, ?string $name, ?string $email, ?string $password): int
    {
        if (!$name || !$email) {
            $this->error('--name and --email are required when creating a new admin.');
            $this->error('Usage: php artisan admin:auth --create --name=John --email=john@example.com [--password=secret]');
            return 1;
        }

        $data = array_filter([
            'name' => $name,
            'email' => $email,
            'password' => $password ?: $adminService->generatePassword(),
        ]);

        $newAdmin = $adminService->createAdmin($data);

        $this->info("Admin created successfully.");
        $this->table(
            ['ID', 'Name', 'Email', 'Password'],
            [[$newAdmin->id, $newAdmin->name, $newAdmin->email, $password ?: '(generated)']]
        );

        return 0;
    }

    protected function updateAdmin(AdminService $adminService, ?string $admin, ?string $email, ?string $name, ?string $password): int
    {
        $target = null;

        if ($admin) {
            if (ctype_digit($admin)) {
                $target = $adminService->getAdmin($admin);
            } else {
                $target = $adminService->getAdminByEmail($admin);
            }
        }

        if (!$target && $email) {
            $target = $adminService->getAdminByEmail($email);
        }

        if (!$target) {
            $this->error('Admin not found.');
            return 1;
        }

        $data = [];

        if ($email) {
            $data['email'] = $email;
        }

        if ($name) {
            $data['name'] = $name;
        }

        if ($password) {
            $data['password'] = $password;
        }

        $updatedAdmin = $adminService->updateAdmin($target->id, $data);

        $this->info("Admin updated successfully.");
        $this->table(
            ['ID', 'Name', 'Email'],
            [[$updatedAdmin->id, $updatedAdmin->name, $updatedAdmin->email]]
        );

        return 0;
    }
}
