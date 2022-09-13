<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      

      return [
          'razao_social' => $this->faker->name,
          'nome_fantasia' => $this->faker->name,
          'cnpj' => $this->faker->name(),
          'telefone' => $this->faker->phoneNumber,
          'email' => $this->faker->email,
          'inicio_atividade' => $this->faker->date,
        ];
    }
}
