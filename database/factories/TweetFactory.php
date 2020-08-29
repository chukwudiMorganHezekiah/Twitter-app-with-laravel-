<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tweet;
use Faker\Generator as Faker;


$factory->define(Tweet::class, function (Faker $faker) {
    $id =0;
    $id+=1;
    return [
        'tweet' => $faker->text,
        'when_tweeted'=>date('Y m h:s:i'),
        'user_id'=>factory(\App\User::class)->create()->id

    ];
});
