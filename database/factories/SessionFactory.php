<?php

use App\Models\Session;
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

$factory->define(Session::class, function (Faker $faker) {
    return [
        'unique_id' => uniqid(). uniqid(),
        'slug' => 'session'.$faker->unique()->slug(),
        'tags' => '',
        'description' => '',
        'created_by' => '1',
        'status' => '1',
        'title' => 'Session'.' - '.uniqid()
    ];
});
