<?php

use Faker\Generator as Faker;

$factory->define(App\Info::class, function (Faker $faker) {
    return [
      'name'          => $faker->name,
      'image'         => $faker->name.'.jpg',
      'screen_name'   => $faker->name,
      'content'       => $faker->realText(100),
      'description'   => $faker->sentence(5),
      'user_name'     => $faker->name,
      'date'          => $faker->date(),
      'status'        => true,
    ];
});
