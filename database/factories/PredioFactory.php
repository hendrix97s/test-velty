<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Predio>
 */
class PredioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'cliente_id' => Cliente::factory(),
          'nome'       => $this->faker->name,
          'descricao'  => $this->faker->text,
        ];
    }
}
