<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Produto::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'preco' => $faker->randomFloat(2,0,8),
        'descricao'=> $faker->text()
    ];
});
