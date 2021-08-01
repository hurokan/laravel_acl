<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('demo.lookupData.roles');
        foreach ($roles as $key=>$role){
            DB::table('roles')->insert([
                'role_name' => $role['role_name'],
                'role_key' => $role['role_key'],
                'has_grand_access' => $role['has_grand_access'],
                'is_enabled' => $role['is_enabled'],
                'guard_name' => $role['guard_name'],
                'created_at' => date("Y/m/d"),
            ]);
        }
    }
}
