<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'super_admin')->firstOrFail();

        $permissions = Permission::all();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );


        $role2 = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::where('table_name', '!=', null)->get();

        $role2->permissions()->sync(
            $permissions->pluck('id')->all()
        );
    }
}
