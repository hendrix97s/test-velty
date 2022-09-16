<?php

namespace Tests\Feature;

use App\Models\Tipagem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TipagemTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function tipagem_index()
  {
    Tipagem::factory(3)->create();

    $response = $this->get(route('tipagem.index'));
    $response->assertStatus(200);
  }

  /** @test */
  public function tipagem_store()
  {
    $payload = [
      'nome' => 'Tipagem Teste',
      'preco' => 10.00,
      'descricao' => 'Descrição da tipagem teste',
    ];

    $response = $this->post(route('tipagem.store'), $payload);
    $response->assertStatus(200);
  }

  /** @test */
  public function tipagem_update()
  {
    $tipagem = Tipagem::factory()->create();
    $params = ['uuid' => $tipagem->uuid];

    $payload = [
      'nome' => 'Tipagem Teste',
      'preco' => 10.00,
      'descricao' => 'Descrição da tipagem teste',
    ];

    $response = $this->put(route('tipagem.update', $params), $payload);
    $response->assertStatus(200);
  }

  /** @test */
  public function tipagem_destroy()
  {
    $tipagem = Tipagem::factory()->create();
    $params = ['uuid' => $tipagem->uuid];

    $response = $this->delete(route('tipagem.destroy', $params));
    $response->assertStatus(200);
  }

}
