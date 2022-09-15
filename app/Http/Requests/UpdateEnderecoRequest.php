<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnderecoRequest extends FormRequest
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
          'cep' => 'required|string',
          'numero' => 'sometimes|string|max:255',
          'complemento' => 'nullable|string|max:255',
          'tipo' => 'required|string|in:cliente,predio',
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
          'cep.required' => 'O CEP é obrigatório',
          'tipo.required' => 'O tipo é obrigatório',
          'tipo.in' => 'O tipo deve ser cliente ou predio',
        ];
    }

    // valida cep
    public function withValidator($validator)
    {
      $this->cep = preg_replace('/[^0-9]/', '', $this->cep);
      $validator->after(function ($validator) {
          if(!preg_match('/^[0-9]{5}[0-9]{3}$/', $this->cep)){
            $validator->errors()->add('cep', 'O CEP é inválido ['.$this->cep.']');
          }
      });
    }
}
