<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class FakeAuthorUsersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = factory(App\User::class, 5)->create();
    }

}
