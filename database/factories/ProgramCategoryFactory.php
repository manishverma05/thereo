<?php

use App\Models\ProgramCategory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(ProgramCategory::class, function (Faker $faker) {
    return [
        'unique_id' => uniqid(). uniqid(),
        'slug' => 'programCategory'.$faker->unique()->slug(),
        'description' => '',
        'created_by' => '1',
        'title' => 'ProgramCategory'.' - '.uniqid()
    ];
});
