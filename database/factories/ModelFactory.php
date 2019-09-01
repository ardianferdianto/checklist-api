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
        'email' => $faker->email,
    ];
});

$factory->define(App\Checklist::class, function (Faker\Generator $faker) {
    return [
        'object_domain' => $faker->randomElement(['contact','deals','note']),
        'object_id' => $faker->randomDigit,
        'description' => $faker->words($nb = 3, $asText = true),
        'is_completed' => $faker->boolean,
        'due' => $faker->dateTimeThisMonth,
        'urgency' => $faker->randomDigit,
        'completed_at' => $faker->dateTimeThisMonth,
        'last_update_by' => $faker->uuid,
    ];
});

$factory->define(App\Item::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->words($nb = 3, $asText = true),
        'is_completed' => $faker->boolean,
        'completed_at' => $faker->dateTimeThisMonth,
        'due' => $faker->dateTimeThisMonth,
        'urgency' => $faker->randomDigit,
        'assignee_id' => $faker->randomDigit,
        'task_id' => $faker->randomDigit,
        'last_update_by' => $faker->uuid,
    ];
});

$factory->define(\App\History::class, function (Faker\Generator $faker) {
   return [
       'loggable_type' => $faker->randomElement(['checklist','items']),
       'loggable_id' => $faker->randomDigit,
       'action' => $faker->randomElement(['create','read','update','delete']),
       'kwuid' => $faker->randomDigit,
       'value' => $faker->word,
   ];
});