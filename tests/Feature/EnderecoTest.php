<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Predio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnderecoTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function when_create_a_addrees_related_with_client()
  {
    $cliente = Cliente::factory()->create();
    
    $payload = [
      'cep'         => '13606-536',
      'numero'      => '123',
      'complemento' => 'casa',
      'tipo'        => 'cliente',
    ];

    $response = $this->post(route('cliente.endereco.store', ['uuid' => $cliente->uuid]), $payload);
    $response->assertStatus(200);
    $response->assertJsonCount(8, 'data');
    $this->assertEquals(__('response.create.success'), $response->json('message'));

  }

  /** @test */
  public function when_create_a_addrees_related_with_predio()
  {
    $predio = Predio::factory()->create();
    
    $payload = [
      'cep'         => '13606-536',
      'numero'      => '123',
      'complemento' => 'casa',
      'tipo'        => 'predio',
    ];

    $response = $this->post(route('predio.endereco.store', ['uuid' => $predio->uuid]), $payload);
    $response->assertStatus(200);
    $response->assertJsonCount(8, 'data');
    $this->assertEquals(__('response.create.success'), $response->json('message'));
  }


  /** @test */
  public function cliente_endereco_update()
  {
    $cliente = Cliente::factory()->create();
    
    $payload = [
      'cep'         => '13606-536',
      'numero'      => '123',
      'complemento' => 'casa',
      'tipo'        => 'cliente',
    ];

    $response = $this->post(route('cliente.endereco.store', ['uuid' => $cliente->uuid]), $payload);
    $response->assertStatus(200);
    $response->assertJsonCount(8, 'data');
    $this->assertEquals(__('response.create.success'), $response->json('message'));

    $payload = [
      'cep'         => '13606-536',
      'numero'      => '123',
      'complemento' => 'predio',
      'tipo'        => 'cliente',
    ];

    $enderecoUuid = $response->json('data.uuid');
    $params = ['uuid' => $cliente->uuid, 'endereco_uuid' => $enderecoUuid];

    $response = $this->put(route('cliente.endereco.update', $params), $payload);
    $response->assertStatus(200);
    $response->assertJsonCount(9, 'data');
    $this->assertEquals(__('response.update.success'), $response->json('message'));
  }

  /** @test */
  public function cliente_endereco_destroy()
  {
    $cliente = Cliente::factory()->create();
    
    $payload = [
      'cep'         => '13606-536',
      'numero'      => '123',
      'complemento' => 'casa',
      'tipo'        => 'cliente',
    ];

    $response = $this->post(route('cliente.endereco.store', ['uuid' => $cliente->uuid]), $payload);
    $response->assertStatus(200);
    $response->assertJsonCount(8, 'data');


    $this->assertEquals(__('response.create.success'), $response->json('message'));

    $response = $this->delete(route('cliente.endereco.destroy', ['uuid' => $cliente->uuid, 'endereco_uuid' => $response->json('data.uuid')]));
    $response->assertStatus(200);
    $response->assertJsonCount(0, 'data');
    $this->assertEquals(__('response.destroy.success'), $response->json('message'));
  }
}
