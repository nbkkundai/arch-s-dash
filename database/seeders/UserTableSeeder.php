<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin_role = Role::where('name','Super Admin')->first();
        $admin_role = Role::where('name','Admin')->first();
        $client_role = Role::where('name','Client')->first();
        
        DB::table('users')->insert([
            'first_name' => 'Kundai',
            'last_name' => 'Ncube',
            'email' => 'kundai@tino.com',
            'phone' => '0766277844',
            'password' => Hash::make('TinoTestPass'),
            'pw_reset_required' => 0,
            'slug' => 'kundai-ncube',
            'email_verified_at' => now(),
            'creator_id'=>1,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'is_active'=>'1',
        ]);

        User::where('email','kundai@tino.com')->first()->assignRole($admin_role);

        DB::table('users')->insert([
            'first_name' => 'Tinotenda',
            'last_name' => 'Ncube',
            'email' => 'tinotenda@tino.com',
            'password' => Hash::make('TinoTestPass'),
            'pw_reset_required' => 0,
            'slug' => 'tinotenda-ncube',
            'email_verified_at' => now(),
            'creator_id'=>1,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'is_active'=>'1',
        ]);
        
        User::where('email','tinotenda@tino.com')->first()->assignRole($super_admin_role);

        DB::table('users')->insert([
            'first_name' => 'Pim',
            'last_name' => 'Ncube',
            'email' => 'pim@tino.com',
            'phone' => '0763572003',
            'password' => Hash::make('TinoTestPass'),
            'pw_reset_required' => 0,
            'slug' => 'pim-ncube',
            'email_verified_at' => now(),
            'creator_id'=>1,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'is_active'=>'1',
        ]);
        
        User::where('email','pim@tino.com')->first()->assignRole($client_role);

    }
}
