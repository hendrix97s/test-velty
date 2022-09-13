<?php

namespace Database\Factories;

use App\Models\Endereco;
use App\Models\EnderecoPredio;
use App\Models\Predio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClienteEndereco>
 */
class EnderecoPredioFactory extends Factory
{

   protected $model = EnderecoPredio::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'predio_id'   => Predio::factory(),
            'endereco_id' => Endereco::factory(),
        ];
    }
}
