<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CamposExtras extends Model
{
    protected $fillable = [
        'codpes',
        'nome',
        'data_nascimento',
        'sexo',
        'pai',
        'mae',
        'endereco',
        'cep',
        'cidade',
        'uf',
        'pais',
        'nacionalidade',
        'telefone',
        'celular',
        'emails',
        'cpf',
        'rg',
        'pis',
        'passaporte',
        'validade_visto',
        'rne',
        'lotado',
        'banco',
        'agencia',
        'conta_corrente',
        'sigla_universidade',
        'docente_usp',
        'empenho',
    ];
}
