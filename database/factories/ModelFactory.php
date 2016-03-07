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
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Account::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\en_US\Company($faker));
    return [
        'name' => $faker->company . ' ' . $faker->companySuffix,
        'description' => $faker->catchPhrase(),
        'account_owner_user_id' => 1,
    ];
});

$factory->define(App\Subscription::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\en_US\Company($faker));
    $faker->addProvider(new Faker\Provider\DateTime($faker));

    return [
        'name' => $faker->catchPhrase(),
        'description' => $faker->text(100),
        'start_date' => $faker->dateTime(),
        'end_date' =>  $faker->dateTime(),
        'account_id' => 1,
        'subscriber_user_id' => 1,
        'channel_id' => 1,
    ];
});

$factory->define(App\Channel::class, function (Faker\Generator $faker) {
    // $faker->addProvider(new Faker\Provider\en_US\Company($faker));

    return [
        'name' => $faker->name,
        'description' => $faker->text(100),
    ];
});