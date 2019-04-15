<?php

use Illuminate\Database\Seeder;
use App\User;

class DefaultAdminUserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::create([
            'username' => 'admin',
            'firstname' => 'Admin',
            'middlename' => '',
            'lastname' => '',
            'email' => 'admin@example.com',
            'role_id' => 1,
            'password' => Hash::make('admin123'),
        ]);
    }

}
