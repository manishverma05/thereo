<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesDefaultSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('roles')->truncate();
        $role_user = new Role();
        $role_user->id = 1;
        $role_user->name = 'Admin';
        $role_user->description = 'Manage admin section';
        $role_user->slug = 'admin';
        $role_user->save();

        $role_user = new Role();
        $role_user->id = 2;
        $role_user->name = 'Customer';
        $role_user->description = 'Front End User';
        $role_user->slug = 'user';
        $role_user->save();

        $role_user = new Role();
        $role_user->id = 3;
        $role_user->name = 'Author';
        $role_user->description = 'Author a admin user';
        $role_user->slug = 'author';
        $role_user->save();
    }

}
