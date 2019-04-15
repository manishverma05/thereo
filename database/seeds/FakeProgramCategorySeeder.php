<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class FakeProgramCategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $programcategories = factory(App\Models\ProgramCategory::class, 5)->create();
    }

}
