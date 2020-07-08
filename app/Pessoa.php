<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Uspdev\Replicado\Pessoa as PessoaReplicado;

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

    public function replicado(){

        $endereco = PessoaReplicado::obterEndereco($this->codpes);
        // Formata endereço
        $endereco = "
            {$endereco['nomtiplgr']} {$endereco['epflgr']} ,
            {$endereco['numlgr']} {$endereco['cpllgr']} -
            {$endereco['nombro']} - {$endereco['cidloc']}  -
            {$endereco['sglest']} - CEP: {$endereco['codendptl']}
        ";
        $dump = PessoaReplicado::dump($this->codpes);

        return [
            'nompes'    => $dump['nompes'],
            'numcpf'    => $dump['numcpf'],
            'telefones' => PessoaReplicado::telefones($this->codpes),
            'emails'    => PessoaReplicado::emails($this->codpes),
            'vinculos'  => PessoaReplicado::vinculos($this->codpes),
            'endereco'  => $endereco,
        ];
    }
}
