<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'cep' => $this->faker->postcode,
          'logradouro'      => '',
          'numero'          => $this->faker->buildingNumber,
          'complemento'     => $this->faker->secondaryAddress,
          'bairro'          => $this->faker->citySuffix,
          'cidade'          => $this->faker->city,
          'uf'              => $this->faker->stateAbbr,
          'url_google_maps' => '',
        ];
    }
}
