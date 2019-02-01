<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    $name = $faker->sentence(2);
    return [
        'name'=>$name,
        'slug'=>str_slug($name),
        'description'=>$faker->text(300),
        'cat_id'=>(\App\Models\Category::query()->inRandomOrder()->limit(1)->get()[0])->id,
        'price'=>$faker->randomFloat(10,0,100),
        'shop_id'=>(\App\Models\Shop::query()->inRandomOrder()->limit(1)->get())[0]->id,
    ];
});
