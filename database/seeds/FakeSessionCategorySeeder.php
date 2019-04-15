<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class FakeSessionCategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $sessioncategories = factory(App\Models\SessionCategory::class, 5)->create();
    }

}
