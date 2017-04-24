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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Models\Challenger::class, function (Faker\Generator $faker) {
	$season = App\Models\Season::whereDate('start_date', '<=', DB::raw('NOW()'))->inRandomOrder()->first();

	return [
		'name' => $faker->name,
		'joined_season_id' => $season->id,
		'join_date' => $faker->dateTimeBetween($season->start_date, $season->end_date ?: 'now')
	];
});

$factory->define(App\Models\ChallengerData::class, function (Faker\Generator $faker) {
	$possible = [
		'3DS Friend Code' => $faker->numerify('####-####-####-####'), 
		'Switch Friend Code' => $faker->numerify('SW####-####-####-####'), 
		'In-Game' => $faker->userName, 
		'Real Name' => $faker->name
	];

	$type = $faker->randomElement(array_keys($possible));

	return [
		'challenger_id' => function() {
			return factory(App\Models\Challenger::class)->create()->id;
		},
		'name' => $type,
		'data' => $possible[$type]
	];
});

$factory->define(App\Models\ChallengerSocial::class, function (Faker\Generator $faker) {
	return [
		'challenger_id' => function() {
			return factory(App\Models\Challenger::class)->create()->id;
		},
		'service' => $faker->randomElement(array_keys(App\Models\ChallengerSocial::services())),
		'account' => $faker->userName
	];
});
