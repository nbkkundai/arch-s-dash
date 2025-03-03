<?php

namespace Modules\Project\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class ProjectDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(\Modules\Project\Database\Seeders\BuildingTypeTableSeeder::class);
        $this->call(\Modules\Project\Database\Seeders\ProjectTableSeeder::class);
        $this->call(\Modules\Project\Database\Seeders\ProcessTableSeeder::class);
        $this->call(\Modules\Project\Database\Seeders\ProcessableTableSeeder::class);
        $this->call(\Modules\Project\Database\Seeders\ProcessQuestionTableSeeder::class);
    }
}
