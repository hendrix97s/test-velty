<?php

namespace Database\Factories;

use App\Models\Predio;
use App\Models\Tipagem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModuloSala>
 */
class SalaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'nome'     => $this->faker->name,
          'numero'     => $this->faker->randomNumber(2),
          'descricao'  => $this->faker->text,
          'predio_id'  => Predio::factory(),
          'tipagem_id' => Tipagem::factory(),
        ];
    }
}
