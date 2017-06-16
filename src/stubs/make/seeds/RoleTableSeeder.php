<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $role_user = new Role();
          $role_user->name = 'role_user';
          $role_user->description= 'Role is User';
          $role_user->save();

          $role_admin = new Role();
          $role_admin->name = 'role_admin';
          $role_admin->description= 'Role is Administrator';
          $role_admin->save();
    }
}
