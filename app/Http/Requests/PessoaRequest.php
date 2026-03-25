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

    public function prepareForValidation()
    {
        if ($this->filled('data_nascimento')) {
            $this->merge([
                'data_nascimento' => $this->convertDate($this->input('data_nascimento')),
            ]);
        }
    }

    private function convertDate($date)
    {
        $d = \DateTime::createFromFormat('d/m/Y', $date);
        return $d ? $d->format('Y-m-d') : $date; // retorna no formato ISO
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codpes'             => 'nullable',
            'nome'               => 'nullable',
            'data_nascimento'    => 'nullable|date',
            'sexo'               => 'nullable|in:F,M',
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
