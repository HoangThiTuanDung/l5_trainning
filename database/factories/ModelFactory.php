<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph
    ];
});

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'user_id' => $faker->randomElement(\App\User::lists('id')->toArray()),
        'category_id' => $faker->randomElement(\App\Category::lists('id')->toArray()),
        'result' =>  $faker->boolean(60)
    ];
});


$factory->define(App\Word::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->paragraph,
        'category_id' => $faker->randomElement(\App\Category::lists('id')->toArray())
    ];
});


$factory->define(App\WordAnswer::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->paragraph,
        'word_id' => $faker->randomElement(\App\Word::lists('id')->toArray()),
        'correct' => $faker->boolean(60)
    ];
});

$factory->define(App\Activity::class, function (Faker\Generator $faker) {
    return [
        'lesson_id' => $faker->randomElement(\App\Lesson::lists('id')->toArray()),
        'user_id' => $faker->randomElement(\App\User::lists('id')->toArray()),
        'words_numbers' => 10
    ];
});


$factory->define(App\LessonWord::class, function (Faker\Generator $faker) {
    return [
        'lesson_id' => $faker->randomElement(\App\Lesson::lists('id')->toArray()),
        'word_id' => $faker->randomElement(\App\Word::lists('id')->toArray()),
        'word_answer_id' => $faker->randomElement(\App\WordAnswer::lists('id')->toArray())
    ];
});
