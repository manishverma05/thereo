<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class FakeMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $materials = factory(App\Models\Material::class, 5)->create();
    }
}
