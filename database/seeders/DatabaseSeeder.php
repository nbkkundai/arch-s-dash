<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Database\Seeders\RoleAndPermissionTableSeeder::class); //seed permissions before users to give users permissions
        $this->call(\Database\Seeders\UserTableSeeder::class);
        $this->call(\Modules\Admin\Database\Seeders\AdminDatabaseSeeder::class);
        $this->call(\Modules\Client\Database\Seeders\ClientDatabaseSeeder::class);
        $this->call(\Modules\Status\Database\Seeders\StatusDatabaseSeeder::class);
        $this->call(\Modules\Project\Database\Seeders\ProjectDatabaseSeeder::class);
    }
}
