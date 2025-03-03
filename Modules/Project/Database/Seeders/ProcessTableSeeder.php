<?php

namespace Modules\Project\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class ProcessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('processes')->insert([
            'name'=>'Stage 0: Viability',
            'order'=> 1,
            'slug'=>'stage-1',
            'description'=> 'Upload deeds from search results',
            'instructions'=>'first do this then...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('processes')->insert([
            'name'=>'Stage 1: Inseption',
            'order'=> 2,
            'slug'=>'stage-2',
            'description'=> 'Upload deeds from search results',
            'instructions'=>'first do this then...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('processes')->insert([
            'name'=>'Stage 2: Concept',
            'order'=> 3,
            'slug'=>'stage-3',
            'description'=> 'Upload deeds from search results',
            'instructions'=>'first do this then...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('processes')->insert([
            'name'=>'Stage 3: Design development',
            'order'=> 4,
            'slug'=>'stage-4',
            'description'=> 'Upload deeds from search results',
            'instructions'=>'first do this then...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('processes')->insert([
            'name'=>'Stage 4: Construction documents',
            'order'=> 5,
            'slug'=>'stage-5',
            'description'=> 'Upload deeds from search results',
            'instructions'=>'first do this then...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('processes')->insert([
            'name'=>'Stage 5: Construction administration',
            'order'=> 5,
            'slug'=>'stage-6',
            'description'=> 'Upload deeds from search results',
            'instructions'=>'first do this then...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('processes')->insert([
            'name'=>'Stage 6: Closeout',
            'order'=> 5,
            'slug'=>'stage-7',
            'description'=> 'Upload deeds from search results',
            'instructions'=>'first do this then...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
