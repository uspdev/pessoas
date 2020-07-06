<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CamposExtrasRequest extends FormRequest
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
            'nome'               => 'nullable',
            'data_nascimento'    => 'nullable|data',
            'codpes'             => 'required|numeric',
            'sexo'               => 'nullable',
            'pai'                => 'nullable',
            'mae'                => 'nullable',
            'endereco'           => 'nullable',
            'cep'                => 'nullable|formato_cep',
            'cidade'             => 'nullable',
            'uf'                 => 'nullable',
            'pais'               => 'nullable',
            'nacionalidade'      => 'nullable',
            'telefone'           => 'nullable|telefone_com_ddd',
            'celular'            => 'nullable|celular_com_ddd',
            'emails'             => 'nullable|email',
            'cpf'                => 'nullable|cpf',
            'rg'                 => 'nullable',
            'pis'                => 'nullable',
            'passaporte'         => 'nullable',
            'validade_visto'     => 'nullable|data',
            'rne'                => 'nullable',
            'banco'              => 'nullable',
            'agencia'            => 'nullable',
            'conta_corrente'     => 'nullable',
            'sigla_universidade' => 'nullable',
        ];
    }
}

