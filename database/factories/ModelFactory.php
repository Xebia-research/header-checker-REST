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

$factory->define(App\Application::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'api_key' => str_random(32),
    ];
});

$factory->define(App\Profile::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'user_agent' => $faker->optional()->userAgent,
    ];
});

/*
 * Profiles - Internet Browsers
 */
$factory->state(App\Profile::class, 'no_user_agent', function (Faker\Generator $faker) {
    return [
        'user_agent' => null,
    ];
});
$factory->state(App\Profile::class, 'chrome', function (Faker\Generator $faker) {
    return [
        'name' => 'Chrome',
        'user_agent' => $faker->chrome,
    ];
});
$factory->state(App\Profile::class, 'firefox', function (Faker\Generator $faker) {
    return [
        'name' => 'Firefox',
        'user_agent' => $faker->firefox,
    ];
});
$factory->state(App\Profile::class, 'safari', function (Faker\Generator $faker) {
    return [
        'name' => 'Safari',
        'user_agent' => $faker->safari,
    ];
});
$factory->state(App\Profile::class, 'opera', function (Faker\Generator $faker) {
    return [
        'name' => 'Opera',
        'user_agent' => $faker->opera,
    ];
});
$factory->state(App\Profile::class, 'internet_explorer', function (Faker\Generator $faker) {
    return [
        'name' => 'Internet Explorer',
        'user_agent' => $faker->internetExplorer,
    ];
});

$factory->define(App\HeaderRule::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'validation_type' => $faker->randomElement([
            'required', 'prohibit', 'equal', 'regex',
        ]),
        'validation_value' => $faker->optional()->sha256,
        'risk_level' => $faker->randomElement([
            'low', 'moderate', 'high', 'critical',
        ]),
    ];
});

/*
 * Header Rules - Validation Types
 */
$factory->state(App\HeaderRule::class, 'validation_required', function () {
    return [
        'validation_type' => 'required',
    ];
});
$factory->state(App\HeaderRule::class, 'validation_prohibit', function () {
    return [
        'validation_type' => 'prohibit',
    ];
});
$factory->state(App\HeaderRule::class, 'validation_equal', function () {
    return [
        'validation_type' => 'equal',
    ];
});
$factory->state(App\HeaderRule::class, 'validation_regex', function () {
    return [
        'validation_type' => 'regex',
    ];
});

/*
 * Header Rules - Risk Levels
 */
$factory->state(App\HeaderRule::class, 'risk_low', function () {
    return [
        'risk_level' => 'low',
    ];
});
$factory->state(App\HeaderRule::class, 'risk_moderate', function () {
    return [
        'risk_level' => 'moderate',
    ];
});
$factory->state(App\HeaderRule::class, 'risk_high', function () {
    return [
        'risk_level' => 'high',
    ];
});
$factory->state(App\HeaderRule::class, 'risk_critical', function () {
    return [
        'risk_level' => 'critical',
    ];
});
