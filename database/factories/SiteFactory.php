<?php

use App\Site;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Site::class, function (Faker $faker) {
    $url = $faker->unique()->url;
    return [
        'title' => $faker->text(20),
        'url' => $url,
        'token' => Hash::make($url),
    ];
});
