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
        $role_user->name = 'Administrators';
        $role_user->description = 'Manage admin section';
        $role_user->slug = 'admin';
        $role_user->save();

        $role_user = new Role();
        $role_user->id = 2;
        $role_user->name = 'Members';
        $role_user->description = 'Front End User';
        $role_user->slug = 'member';
        $role_user->save();

        $role_user = new Role();
        $role_user->id = 3;
        $role_user->name = 'Authors';
        $role_user->description = 'Authors';
        $role_user->slug = 'author';
        $role_user->save();

        $role_user = new Role();
        $role_user->id = 4;
        $role_user->name = 'Subscribers';
        $role_user->description = 'Subscribers';
        $role_user->slug = 'subscriber';
        $role_user->save();

        $role_user = new Role();
        $role_user->id = 5;
        $role_user->name = 'Guests';
        $role_user->description = 'Guests user';
        $role_user->slug = 'guest';
        $role_user->save();
    }

}
