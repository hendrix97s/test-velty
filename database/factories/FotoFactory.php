<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Foto>
 */
class FotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      return [
        'url'       => $this->faker->imageUrl(640, 480, 'cats', true, 'Faker'),
        'path'      => $this->faker->filePath(),
        'nome'      => $this->faker->name,
        'descricao' => $this->faker->text,
      ];
    }
}
