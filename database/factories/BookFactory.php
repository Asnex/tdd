<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use \App\Models\Author;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'author_id' => factory(Author::class)
    ];
});
