<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
          'razao_social'     => 'required|string|max:255',
          'nome_fantasia'    => 'required|string|max:255',
          'cnpj'             => 'required|string|max:17|unique:clientes',
          'telefone'         => 'required|string|max:20',
          'email'            => 'required|string|max:255',
          'inicio_atividade' => 'required|date',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
          'razao_social.required'     => 'A razão social é obrigatória',
          'nome_fantasia.required'    => 'O nome fantasia é obrigatório',
          'cnpj.required'             => 'O CNPJ é obrigatório',
          'cnpj.unique'               => 'O CNPJ já está cadastrado',
          'telefone.required'         => 'O telefone é obrigatório',
          'email.required'            => 'O e-mail é obrigatório',
          'inicio_atividade.required' => 'A data de início de atividade é obrigatória',
        ];
    }

}
