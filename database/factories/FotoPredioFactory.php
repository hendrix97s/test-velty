<?php

namespace Database\Factories;

use App\Models\Foto;
use App\Models\Predio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FotoPredio>
 */
class FotoPredioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'predio_id' => Predio::factory(),
          'foto_id'   => Foto::factory(),
        ];
    }
}
