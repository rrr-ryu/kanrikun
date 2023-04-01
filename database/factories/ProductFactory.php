<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Product::class, function (Faker $faker) {
    return [
        'company_id' => $faker->numberBetween(1, 4),
        'product_name' => $faker->name,
        'price' => $faker->numberBetween(100, 1000),
        'stock' => $faker->numberBetween(0, 1000),
        'comment' => $faker->text,
        'img_path' => 'sample'. $faker->numberBetween(1, 4). '.jpg',
    ];
});
