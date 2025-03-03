<?php

namespace Modules\Project\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('projects')->insert([       
            'name' => "Project ABC",
            'location' => '2229 Tynwald South',
            'building_type_id' => 1,
            'client_id' => 3,
            'budget' => '1500',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);    

        DB::table('project_architect')->insert([       
            'project_id' => 1,
            'architect_id' => 2,
        ]); 
    }
}
