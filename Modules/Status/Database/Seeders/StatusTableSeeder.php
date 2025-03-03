<?php

namespace Modules\Status\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user_statuses = [
            [
                'name'=>'Activated',
                'description' => 'The user or organisation does have access to the system.',
                'code' => 100
            ],
            [
                'name'=>'Deactivated',
                'description' => 'The user or organisation cannot access the system.',
                'code' => 900
            ],
        ];

        foreach ($user_statuses as $status) {
            DB::table('statuses')->insert([
                'name' => $status['name'],
                'model' => 'App\Models\User',
                'description' => $status['description'],
                'code' => $status['code'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }



        $project_statuses = [
            [
                'name'=>'New',
                'description' => 'This project has just been created.',
                'code' => 100
            ],
            [
                'name'=>'In Progress',
                'description' => 'This project is being processed.',
                'code' => 300
            ],
            [
                'name'=>'Completed',
                'description' => 'This project has been signed off.',
                'code' => 700
            ],
        ];


        foreach ($project_statuses as $status) {
            DB::table('statuses')->insert([
                'name' => $status['name'],
                'model' => 'Modules\Project\Entities\Project',
                'description' => $status['description'],
                'code' => $status['code'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach ($project_statuses as $status) {
            DB::table('statuses')->insert([
                'name' => $status['name'],
                'model' => 'Modules\Project\Entities\Processable',
                'description' => $status['description'],
                'code' => $status['code'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        //seed users' statuses
        DB::table('statusables')->insert([
            'status_id'=>1, //Activated / 200
            'statusable_id'=>1, //Vasheer
            'statusable_type'=>'App\Models\User'
        ]);
        DB::table('statusables')->insert([
            'status_id'=>1, //Activated / 200
            'statusable_id'=>2, //Robert
            'statusable_type'=>'App\Models\User'
        ]);
        DB::table('statusables')->insert([
            'status_id'=>1, //Activated / 200
            'statusable_id'=>3, //Extension
            'statusable_type'=>'App\Models\User'
        ]);
        DB::table('statusables')->insert([
            'status_id'=>1, //Activated / 200
            'statusable_id'=>4, //Client
            'statusable_type'=>'App\Models\User'
        ]);
        DB::table('statusables')->insert([
            'status_id'=>1, //Activated / 200
            'statusable_id'=>5, //Admin
            'statusable_type'=>'App\Models\User'
        ]);
        DB::table('statusables')->insert([
            'status_id'=>1, //Activated / 200
            'statusable_id'=>6, //Super
            'statusable_type'=>'App\Models\User'
        ]);

        $client_statuses = [
            [
                'name'=>'New',
                'description' => 'New',
                'code' => 200
            ],
            [
                'name'=>'Active',
                'description' => 'Active',
                'code' => 300
            ],
            [
                'name'=>'Inactive',
                'description' => 'Inactive',
                'code' => 400
            ],
            [
                'name'=>'Delinquent',
                'description' => 'Delinquent',
                'code' => 900
            ],
        ];

        foreach ($client_statuses as $status) {
            DB::table('statuses')->insert([
                'name' => $status['name'],
                'model' => 'Modules\Client\Entities\Client',
                'description' => $status['description'],
                'code' => $status['code'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        //seed clients' statuses
        DB::table('statusables')->insert([
            'status_id'=>3, // New / 200
            'statusable_id'=>1, // Example
            'statusable_type'=>'Modules\Client\Entities\Client',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        DB::table('statusables')->insert([
            'status_id'=>3, // New / 200
            'statusable_id'=>2, // Jimmy
            'statusable_type'=>'Modules\Client\Entities\Client',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        DB::table('statusables')->insert([
            'status_id'=>3, // New / 200
            'statusable_id'=>3, // Jane
            'statusable_type'=>'Modules\Client\Entities\Client',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);

    }
}
