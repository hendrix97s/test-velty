<?php

namespace Tests\Unit;

use App\Models\Endereco;
use App\Models\EnderecoPredio;
use App\Models\FotoPredio;
use App\Models\Predio;
use App\Models\Sala;
use Database\Factories\SalaFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PredioTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function when_create_a_predio()
    {
        $this->withoutExceptionHandling();
        
        $predio = Predio::factory()->create();
        FotoPredio::factory()->create([
            'predio_id' => $predio->id,
        ]);
        $this->assertCount(5, $predio->toArray());
        $this->assertCount(8, $predio->cliente->toArray());
    }

    /** @test */
    public function when_create_predio_with_sala_client_and_photos()
    {

        $this->withoutExceptionHandling();
        
        $predio = Predio::factory()->create();

        $endereco = Endereco::factory()->create();

        EnderecoPredio::factory()->create([
          'predio_id' => $predio->id,
          'endereco_id' => $endereco->id,
        ]);

        FotoPredio::factory(3)->create([
            'predio_id' => $predio->id,
        ]);

        Sala::factory(2)->create([
            'predio_id' => $predio->id,
        ]);

        $this->assertCount(5, $predio->toArray());
        $this->assertCount(8, $predio->cliente->toArray());
        $this->assertCount(2, $predio->salas->toArray());
        $this->assertCount(3, $predio->fotos->toArray());
    }
}
