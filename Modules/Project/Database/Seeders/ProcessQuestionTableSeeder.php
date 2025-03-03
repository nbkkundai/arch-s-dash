<?php

namespace Modules\Project\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class ProcessQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('process_questions')->insert([
            'process_id'=> 1,
            'name'=>"Design brief formulation",
            'type'=> 'upload',
            'is_active'=>1,
            'is_required'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('process_questions')->insert([
            'process_id'=> 1,
            'name'=>"Upload site plan",
            'type'=> 'upload',
            'is_active'=>1,
            'is_required'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('process_questions')->insert([
            'process_id'=> 2,
            'name'=>"question 2",
            'type'=> 'number',
            'is_active'=>1,
            'is_required'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('process_questions')->insert([
            'process_id'=> 3,
            'name'=>"What's your dream car?",
            'type'=> 'single_select',
            'is_active'=>1,
            'is_required'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('process_questions')->insert([
            'process_id'=> 4,
            'name'=>"Where have you stayed before?",
            'type'=> 'multi_select',
            'is_active'=>1,
            'is_required'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('process_questions')->insert([
            'process_id'=> 5,
            'name'=>"whats your name",
            'type'=> 'text',
            'is_active'=>1,
            'is_required'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('process_questions')->insert([
            'process_id'=> 5,
            'name'=>"whats your address",
            'type'=> 'text',
            'is_active'=>1,
            'is_required'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // seeding the question options 
        DB::table('process_question_options')->insert([
            'process_question_id'=> 3,
            'name'=>"BWM",
            'value'=> 'Bwm',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('process_question_options')->insert([
            'process_question_id'=> 3,
            'name'=>"Toyota",
            'value'=> 'Toyota',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('process_question_options')->insert([
            'process_question_id'=> 3,
            'name'=>"Tesla",
            'value'=> 'Tesla',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('process_question_options')->insert([
            'process_question_id'=> 4,
            'name'=>"South Africa",
            'value'=> 'South Africa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('process_question_options')->insert([
            'process_question_id'=> 4,
            'name'=>"Zimbabwe",
            'value'=> 'Zimbabwe',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('process_question_options')->insert([
            'process_question_id'=> 4,
            'name'=>"Tanzania",
            'value'=> 'Tanzania',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('process_question_options')->insert([
            'process_question_id'=> 4,
            'name'=>"Zambia",
            'value'=> 'Zambia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
