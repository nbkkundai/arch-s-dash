<?php

namespace Modules\Project\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class BuildingTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
       
        DB::table('building_types')->insert([       
            'name' => "Stand alone house",
            'description' => 'a house that isnt within a complex bluh bluh...',
        ]);    
    }
}
