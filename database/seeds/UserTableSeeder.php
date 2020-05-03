<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::find(1);

        $superAdmin = Role::where('name','superadmin')->first();

        $admin->role()->attach($superAdmin);
    }
}
