<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Shop::class, function (Faker $faker) {
    $name =$faker->word;
    return [
        'name'=>$name,
        'slug'=>str_slug($name),
        'description'=>$faker->text(300),

    ];
});
