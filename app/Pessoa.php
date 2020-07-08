<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $guarded = ['id'];

    public function getDataNascimentoAttribute($value)
    {
        return implode('/', array_reverse(explode('-', $value)));
    }

    public function setDataNascimentoAttribute($value)
    {
        if(!empty($value))
            $this->attributes['data_nascimento'] = implode('-', array_reverse(explode('/', $value)));
    }

    public function getValidadeVistoAttribute($value)
    {
        if(!empty($value))
            return implode('/', array_reverse(explode('-', $value)));
    }

    public function setValidadeVistoAttribute($value)
    {
        if(!empty($value))
            $this->attributes['validade_visto'] = implode('-', array_reverse(explode('/', $value)));
    }

    public function getCpfAttribute($value)
    {
        if(!empty($value))
            return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
    }

    public function setCpfAttribute($value)
    {
        if(!empty($value))
            $this->attributes['cpf'] = preg_replace("/[^0-9]/", "", $value);
    }
}
