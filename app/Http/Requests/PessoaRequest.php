<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codpes'             => '',
            'nome'               => '',
            'data_nascimento'    => 'nullable|data',
            'sexo'               => '',
            'pai'                => '',
            'mae'                => '',
            'endereco'           => '',
            'cep'                => 'nullable|formato_cep',
            'cidade'             => '',
            'uf'                 => '',
            'pais'               => '',
            'nacionalidade'      => '',
            'telefone'           => 'nullable|telefone_com_ddd',
            'celular'            => 'nullable|celular_com_ddd',
            'emails'             => 'nullable|email',
            'cpf'                => 'nullable|cpf',
            'rg'                 => '',
            'pis'                => '',
            'passaporte'         => '',
            'validade_visto'     => 'nullable|data',
            'rne'                => '',
            'banco'              => '',
            'agencia'            => '',
            'conta_corrente'     => '',
            'sigla_universidade' => '',
        ];
    }
}

