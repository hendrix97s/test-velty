<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipagemSala>
 */
class TipagemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      return [
        'nome'      => $this->faker->name,
        'preco'     => $this->faker->randomFloat(2, 0, 1000),
        'descricao' => $this->faker->text,
      ];
    }
}
