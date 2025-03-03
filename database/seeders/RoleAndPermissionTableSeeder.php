<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use DB;

class RoleAndPermissionTableSeeder extends Seeder
{
    /**
     * Function to create a permission for each role if it does not exist
     */
    private function assign_permission($role_name, $permission_name)
    {
        $permission = Permission::where('name',$permission_name)->first();
        $role = Role::where('name',$role_name)->first();

        if(!$permission) {
            DB::table('permissions')->insert([
                'name' => $permission_name,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $permission = Permission::where('name',$permission_name)->first();
        }

        DB::table('role_has_permissions')->insert([
            'permission_id' => $permission->id,
            'role_id' => $role->id,
        ]);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Note: all permissions must be two words for CASL


        //admin role and permissions
            DB::table('roles')->insert([
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $admin_perms = [
                'view users',
                'create users',
                'edit users',
                'activate users',
                'delete users',

                'view clients',
                'create clients',
                'edit clients',
                'delete clients',

                'view any upload',
                'create upload',
                'delete any upload',

                'view projects',
                'create projects',
                'edit projects',
                'delete projects',

                'view all projects',
                'view all processes',
                'view processes',
                'create processes',
                'edit processes',
                'delete processes',
            ];

            foreach($admin_perms as $perm) {
                $this->assign_permission('Admin', $perm);
            }

        //Super Admin role and permissions
            DB::table('roles')->insert([
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $super_admin_perms = [
                'view users',
                'create users',
                'edit users',
                'activate users',
                'delete users',

                'view clients',
                'create clients',
                'edit clients',
                'delete clients',

                'delete notes',

                'view any upload',
                'delete any upload',
                'create upload',

                'view all projects',
                'view projects',
                'create projects',
                'edit projects',
                'delete projects',

                'view processes',
                'view all processes',
                'create processes',
                'edit processes',
                'delete processes',
            ];

            foreach($super_admin_perms as $perm) {
                $this->assign_permission('Super Admin', $perm);
            }

        //client role and permissions
            DB::table('roles')->insert([
                'name' => 'Client',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $client_perms = [
                'view any upload',
                'create upload',
                'delete any upload',

                'view projects',
            ];

            foreach($client_perms as $perm) {
                $this->assign_permission('Client', $perm);
            }
    }
}
