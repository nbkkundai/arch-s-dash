<?php

namespace Modules\Status\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Status\Database\Seeders\StatusTableSeeder;

class StatusDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(StatusTableSeeder::class);
    }
}
