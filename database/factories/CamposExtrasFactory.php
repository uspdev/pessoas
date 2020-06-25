<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CamposExtras;
use Faker\Generator as Faker;

$factory->define(CamposExtras::class, function (Faker $faker) {

    $sexo = array(
        'Feminino',
        'Masculino',
    );

    $docente_usp = array(
        'Sim',
        'Não',
    );

    $nacionalidade = array(
        'Brasileiro',
        'Angolano',
        'Italiano',
        'Alemão',
    );

    $sigla_universidade = array(
        'FGV - SP',
        'USP - SP',
        'UNIFESP - SP',
        'UNESP - SP',
    );

    return [
        'codpes' => $faker->unique()->numberBetween(10000, 999999),
        'nome' => $faker->name,
        'data_nascimento' => $faker->date,
        'validade_visto' => $faker->date,
        'cpf' => $faker->cpf,
        'rg' => $faker->rg,
        'endereco' => $faker->address,
        'pai' => $faker->name,
        'mae' => $faker->name,
        'emails' => $faker->email,
        'sexo' => $sexo[array_rand($sexo)],
        'docente_usp' => $docente_usp[array_rand($docente_usp)],
        'celular' => $faker->cellphoneNumber,
        'telefone' => $faker->phone,
        'pis' => $faker->unique()->numberBetween(10000000000, 99999999999),
        'banco' => $faker->bank,
        'conta_corrente' => $faker->bankAccountNumber,
        'agencia' => $faker->unique()->numberBetween(0000, 9999),
        'cidade' => $faker->city,
        'pais' => $faker->country,
        'uf' => $faker->stateAbbr,
        'cep' => $faker->postcode,
        'nacionalidade' => $nacionalidade[array_rand($nacionalidade)],
        'sigla_universidade' => $sigla_universidade[array_rand($sigla_universidade)],
        'rne' => $faker->unique()->numberBetween(10000000000, 99999999999),
        'passaporte' => $faker->unique()->numberBetween(10000000000, 99999999999),
        'lotado' => 'lotado',
        'empenho' => 'empenho',
    ];
});
