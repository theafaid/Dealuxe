<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::where('name', 'super_admin')->firstOrFail();

        User::create([
            'name'           => 'Super Admin',
            'email'          => 'super_admin@super_admin.com',
            'password'       => bcrypt(config('voyager.adminPassword')),
            'remember_token' => str_random(60),
            'role_id'        => $role1->id,
        ]);

        $role2 = Role::where('name', 'admin')->firstOrFail();

        User::create([
            'name'           => 'Admin',
            'email'          => 'admin@admin.com',
            'password'       => bcrypt('password'),
            'remember_token' => str_random(60),
            'role_id'        => $role2->id,
        ]);
    }
}
