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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\SolarSystem::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'max_planets' => $faker->randomNumber($nbDigits = 2),
        'location' => createLocation($faker)
    ];
});

$factory->define(App\PlanetType::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'type' => $faker->word,
        'img_path' => $faker->imageUrl(640, 480) //currently this is for testing, it should reference img directory
    ];
});

$factory->define(App\Planet::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->city,
        'radius' => $faker->randomNumber($nbDigits = 6),
        'metal' => $faker->randomNumber($nbDigits = 5),
        'wood' => $faker->randomNumber($nbDigits = 5),
        'energy' => $faker->randomNumber($nbDigits = 5),
        'solarSystem_id' => \App\SolarSystem::all()->random()->id,
        'planetType_id' => \App\PlanetType::all()->random()->id,
        'user_id' => \App\User::all()->random()->id
    ];
});

function createLocation($faker)
{
    $json = array();
    // this is assuming solar system panel is 640x640
    array_push($json, $faker->numberBetween(0, 640)); // for x location
    array_push($json, $faker->numberBetween(0, 640)); // for y location
    return $json;
}

//function createReso($faker)
//{
//    $json = [
//        "gold" => $faker->randomNumber($nbDigits = 5),
//        "silver" => $faker->randomNumber($nbDigits = 5),
//        "wood" => $faker->randomNumber($nbDigits = 5)
//    ];
//    echo json_encode($json);
//    return $json;
//}