<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalaRequest extends FormRequest
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
        'nome' => 'required|string',
        'numero' => 'required|integer', 
        'descricao' => 'required|string', 
        'tipagem_uuid' => 'required|string|exists:tipagem,uuid',
      ];
    }
}
