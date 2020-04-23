<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\Article;
use App\Models\Transaction;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(Article::class, function (Faker $faker) {
    return [
        'author' => $faker->name,
        'reviewer' => $faker->userName,
        'title' => 'title' . $faker->numberBetween(1, 1000),
        'content_short' => $faker->text(20),
        'content' => $faker->text,
        'forecast' => $faker->randomFloat(2, 0, 100),
        'importance' => $faker->numberBetween(1, 3),
        'type' => $faker->randomElement(['CN', 'US', 'JP', 'EU']),
        'status' => $faker->randomElement(['published', 'draft']),
        'comment_disabled' => $faker->randomElement([true, false]),
        'pageviews' => $faker->numberBetween(0, 100000),
        'image_uri' => $faker->imageUrl,
        'platforms' => json_encode(['a-platform']),
        'remark' => 'This is a test remark.',
        'display_time' => $faker->dateTime,
    ];
});


$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'order_no' => $faker->uuid,
        'username' => $faker->userName,
        'price' => $faker->randomFloat(2, 0, 100),
        'status' => $faker->randomElement(['success', 'pending']),
    ];
});
