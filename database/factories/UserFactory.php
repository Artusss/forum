<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Topic;
use App\User;
use App\Decision;
use App\Category;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(Category::class, function(Faker $faker){
    $title = $faker->sentence(2);
    return [
        'title' => $title,
        'slug' => str_slug($title),
    ];
});
$factory->define(Topic::class, function(Faker $faker){
    $title = $faker->sentence(4);
    return [
        'author_id' => $faker->numberBetween(3, 4),
        'category_id' => 1,
        'title' => $title,
        'body' => $faker->text(750),
        'slug' => str_slug($title),
    ];
});
$factory->define(Decision::class, function(Faker $faker){
    return [
        'author_id' => $faker->numberBetween(3, 4),
        'topic_id' => 1,
        'body' => $faker->text(500),
    ];
});
