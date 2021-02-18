<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
      'title' => $faker -> word,
      'content' => $faker -> paragraph(20),
      'likes' => rand(0, 2000),
    ];
});
