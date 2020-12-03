<?php

namespace Database\Factories;

use App\Models\Pessoa;
use Illuminate\Database\Eloquent\Factories\Factory;

#use Faker\Generator as Faker;

class PessoaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pessoa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pessoa = [
            $this->faker->unique()->docente,
            $this->faker->unique()->servidor,
        ];

        $sexo = array(
            'Feminino',
            'Masculino',
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
            'codpes' => $pessoa[array_rand($pessoa)],
            'nome' => $this->faker->name,
            'data_nascimento' => $this->faker->date,
            'validade_visto' => $this->faker->date,
            'cpf' => $this->faker->cpf(false),
            'rg' => $this->faker->rg(false),
            'endereco' => $this->faker->address,
            'pai' => $this->faker->name,
            'mae' => $this->faker->name,
            'emails' => $this->faker->email,
            'sexo' => $sexo[array_rand($sexo)],
            'celular' => $this->faker->cellphoneNumber,
            'telefone' => $this->faker->phone,
            'pis' => $this->faker->unique()->numberBetween(10000000000, 99999999999),
            'banco' => $this->faker->bank,
            'conta_corrente' => $this->faker->bankAccountNumber,
            'agencia' => $this->faker->unique()->numberBetween(0000, 9999),
            'cidade' => $this->faker->city,
            'pais' => $this->faker->country,
            'uf' => $this->faker->stateAbbr,
            'cep' => $this->faker->postcode,
            'nacionalidade' => $nacionalidade[array_rand($nacionalidade)],
            'sigla_universidade' => $sigla_universidade[array_rand($sigla_universidade)],
            'rne' => $this->faker->unique()->numberBetween(10000000000, 99999999999),
            'passaporte' => $this->faker->unique()->numberBetween(10000000000, 99999999999),
        ];
    }
}

