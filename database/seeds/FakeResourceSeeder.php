<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class FakeResourceSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $resources = factory(App\Models\Resource::class, 5)->create();
    }

}
