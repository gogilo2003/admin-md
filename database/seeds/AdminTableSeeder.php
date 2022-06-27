<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ogilo\AdminMd\Models\Admin::create([
        		'name' => 'Admin User',
        		'email' => 'admin@example.com',
        		'password' => bcrypt('Secrate'),
        		'admin_role_id' => 1,
        	]);
    }
}
