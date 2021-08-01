<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user_super_admin = [
            'name' => 'Super Admin',
            'email' => 'admin@demo.com',
            'email_verified_at' => now(),
            'role_id' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
        $user = New \App\Models\Acl\User();
        $user->fill($user_super_admin);
        $user->save();

        $this->call(RoleSeeder::class);
    }
}
