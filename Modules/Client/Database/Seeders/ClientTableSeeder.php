<?php

namespace Modules\Client\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Client\Entities\Client;
use Carbon\Carbon;
use DB;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Client::factory()->count(900)->create();
        DB::table('clients')->insert([       
                'code'=>1,  
                'slug'=>'j-dore',
                'initials'=>'J',  
                'last_name'=>'Dore',
                'id_number'=>'9212105322087',
                'phone'=>'0766277844',
                'client_number'=>'C1',  
                'creator_id'=>'3',
                'centre_id'=>1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::table('clients')->insert([       
                'code'=>2,  
                'slug'=>'j-dore',
                'initials'=>'T',  
                'last_name'=>'Test',
                'id_number'=>'9212105322088',
                'phone'=>'0766277844',
                'client_number'=>'C2',  
                'creator_id'=>'3',
                'centre_id'=>1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::table('clients')->insert([       
                'code'=>3,  
                'slug'=>'j-dore',
                'initials'=>'Demo',  
                'last_name'=>'Tester',
                'id_number'=>'9212105322089',
                'phone'=>'0766277844',
                'client_number'=>'C3',  
                'creator_id'=>'3',
                'centre_id'=>1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

 
    }
}
