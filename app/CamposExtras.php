<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CamposExtras extends Model
{
    protected $fillable = [
        'codpes',
        'data_nascimento',
        'nome',
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
        'banco',
        'agencia',
        'conta_corrente',
        'sigla_universidade',
    ];

    public function getDataNascimentoAttribute($value)
    {
        return implode('/', array_reverse(explode('-', $value)));
    }

    public function setDataNascimentoAttribute($value)
    {
        $this->attributes['data_nascimento'] = implode('-', array_reverse(explode('/', $value)));
    }

    public function getValidadeVistoAttribute($value)
    {
        return implode('/', array_reverse(explode('-', $value)));
    }

    public function setValidadeVistoAttribute($value)
    {
        $this->attributes['validade_visto'] = implode('-', array_reverse(explode('/', $value)));
    }

    public function getCpfAttribute($value)
    {
        return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = preg_replace("/[^0-9]/", "", $value);
    }
}