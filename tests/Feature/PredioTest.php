<?php

namespace Tests\Feature;

use App\Models\Predio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PredioTest extends TestCase
{

  use RefreshDatabase;

  /** @test*/
  public function when_create_a_predio_with_predio()
  {

    $predio = Predio::factory()->create();
    
    $payload = [
      'cep'         => '13606-536',
      'numero'      => '123',
      'complemento' => 'predio',
      'tipo'        => 'predio',
    ];

    $this->post(route('predio.endereco.store', ['uuid' => $predio->uuid]), $payload);
    $response = $this->get(route('predio.show', ['uuid' => $predio->uuid]));
    $response->assertStatus(200);
    $response->assertJsonCount(9, 'data.endereco');
    $response->assertJsonCount(8, 'data');
    $this->assertEquals(__('response.show.success'), $response->json('message'));
  }
}
