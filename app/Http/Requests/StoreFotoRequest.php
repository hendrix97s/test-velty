<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFotoRequest extends FormRequest
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
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string|max:255',
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'tipo' => 'required|string|max:255|in:predio,sala',
      ];
    }
}
