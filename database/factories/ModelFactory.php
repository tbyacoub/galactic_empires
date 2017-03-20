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
    static $password;

    return [
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'api_token' => str_random(60),
    ];
});

$factory->define(App\SolarSystem::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'max_planets' => $faker->randomNumber($nbDigits = 2),
        'location' => createLocationFaker($faker)
    ];
});

$factory->define(App\PlanetType::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->unique()->word,
        'type' => $faker->word,
        'img_path' => $faker->imageUrl(640, 480) //currently this is for testing, it should reference img directory
    ];
});

$factory->define(App\Planet::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->unique()->city,
        'radius' => $faker->randomNumber($nbDigits = 6),
        'resources' => createReso($faker),
        'solarSystem_id' => \App\SolarSystem::all()->random()->id,
        'planetType_id' => \App\PlanetType::all()->random()->id,
    ];
});

$factory->defineAs(App\Planet::class, 'unassigned', function (Faker\Generator $faker) {

    return [
        'name' => $faker->city,
        'radius' => $faker->randomNumber($nbDigits = 6),
        'resources' => createReso($faker),
        'solarSystem_id' => \App\SolarSystem::all()->random()->id,
        'planetType_id' => \App\PlanetType::all()->random()->id,
        'user_id' => -1
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->word,
        'content' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'post_date' => $faker->dateTime(),
        'user_id' => \App\User::all()->random()->id
    ];
});

$factory->define(App\Mail::class, function (Faker\Generator $faker) {

    return [
        'sender_id' => App\User::all()->random()->id,
        'receiver_id' => App\User::all()->random()->id,
        'subject' => $faker->word,
        'message' => $faker->text($maxNbChars = 200),
        'read' => false,
        'favorite' => false
    ];
});

function createLocationFaker($faker)
{
    $json = array();
    // this is assuming solar system panel is 640x640
    array_push($json, $faker->numberBetween(0, 640)); // for x location
    array_push($json, $faker->numberBetween(0, 640)); // for y location
    return $json;
}

function createLocation($pos_x, $pos_y)
{
    $json = array();
    array_push($json, $pos_x); // for x location
    array_push($json, $pos_y); // for y location
    return $json;
}

function createReso($faker)
{
    $json = [
        "metal" => 1000,
        "crystal" => 1000,
        "energy" => 1000
    ];
    return $json;
}
