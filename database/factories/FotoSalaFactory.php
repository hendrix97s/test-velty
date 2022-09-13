<?php

namespace Database\Factories;

use App\Models\Foto;
use App\Models\Sala;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FotoSalaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'sala_id' => Sala::factory(),
          'foto_id' => Foto::factory(),
        ];
    }
}
