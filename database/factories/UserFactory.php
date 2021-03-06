<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Article;
use App\Word;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('secret'), // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigit(),
        'title' => $faker->name,
        'article' => $faker->text,
        'summary' => $faker->text,
        'status' => 'draft',
    ];
});

$factory->define(Word::class, function (Faker $faker) {
    return [
        'word' => $faker->name,
        'mean' => $faker->name,
        'sampletext' => $faker->text,
        'article_id' => $faker->randomDigit(),
    ];
});
