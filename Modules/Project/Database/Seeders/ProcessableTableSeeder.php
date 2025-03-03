<?php

namespace Modules\Project\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class ProcessableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('processables')->insert([
            'process_id'=>1,
            'processable_id'=>1,
            'processable_type'=>'Modules\\Project\\Entities\\Project',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('statusables')->insert([
            'status_id'=>3,
            'statusable_id'=>1,
            'statusable_type'=>'Modules\Project\Entities\Processable',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('processables')->insert([
            'process_id'=>2,
            'processable_id'=>1,
            'processable_type'=>'Modules\\Project\\Entities\\Project',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('statusables')->insert([
            'status_id'=>3,
            'statusable_id'=>2,
            'statusable_type'=>'Modules\Project\Entities\Processable',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('processables')->insert([
            'process_id'=>3,
            'processable_id'=>1,
            'processable_type'=>'Modules\\Project\\Entities\\Project',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('statusables')->insert([
            'status_id'=>3,
            'statusable_id'=>3,
            'statusable_type'=>'Modules\Project\Entities\Processable',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('processables')->insert([
            'process_id'=>4,
            'processable_id'=>1,
            'processable_type'=>'Modules\\Project\\Entities\\Project',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('statusables')->insert([
            'status_id'=>3,
            'statusable_id'=>4,
            'statusable_type'=>'Modules\Project\Entities\Processable',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
