<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\ClienteEndereco;
use App\Models\Endereco;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClienteEndereco>
 */
class ClienteEnderecoFactory extends Factory
{

   protected $model = ClienteEndereco::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cliente_id' => Cliente::factory(),
            'endereco_id' => Endereco::factory(),
        ];
    }
}
