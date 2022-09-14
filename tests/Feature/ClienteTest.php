<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test*/
    public function when_create_a_cliente()
    {
        $payload = [
          'razao_social' => 'Luiz F. Lima',
          'nome_fantasia' => 'lf system',
          'cnpj' => '43897291000175',
          'telefone' => '11999999999',
          'email' => 'lf.system@outlook.com',
          'inicio_atividade' => '2021-10-29',
        ];

        $response = $this->post(route('cliente.store'), $payload);
        $response->assertStatus(200);
    }

    /** @test*/
    public function when_create_a_cliente_with_existing_cnpj()
    {
      Cliente::factory()->create([
        'cnpj' => '43897291000175',
      ]);

      $payload = [
        'razao_social' => 'Luiz F. Lima',
        'nome_fantasia' => 'lf system',
        'cnpj' => '43897291000175',
        'telefone' => '11999999999',
        'email' => 'lf.system@outlook.com',
        'inicio_atividade' => '2021-10-29',
      ];

      $response = $this->post(route('cliente.store'), $payload);
      $this->assertEquals('Falha ao processar requisição', $response->json('message'));
      $this->assertEquals('O CNPJ já está cadastrado', $response->json('data.cnpj.0'));
      $response->assertStatus(400);
    }

    /** @test*/
    public function when_show_a_cliente()
    {
      $cliente = Cliente::factory()->create();
      $response = $this->get(route('cliente.show', ['uuid' => $cliente->uuid]));
      $response->assertStatus(200);
      $response->assertJsonCount(8, 'data');
    }

    /** @test*/
    public function when_requesting_the_client_list()
    {
      Cliente::factory()->count(3)->create();
      $response = $this->get(route('cliente.index'));
      $response->assertStatus(200);
      $response->assertJsonCount(3, 'data');
    }

    /** @test*/
    public function when_update_a_cliente()
    {
      $cliente = Cliente::factory()->create();
      $payload = [
        'razao_social' => 'Luiz F. Lima updated',
        'nome_fantasia' => 'lf system',
        'cnpj' => '43897291000175',
        'telefone' => '11999999999'
      ];

      $response = $this->put(route('cliente.update', ['uuid' => $cliente->uuid]), $payload);
      $response->assertStatus(200);
      $this->assertEquals('Luiz F. Lima updated', $response->json('data.razao_social'));
      $this->assertEquals(__('response.update.success'), $response->json('message'));
    }

    /** @test*/
    public function when_delete_a_cliente()
    {
      $cliente = Cliente::factory()->create();
      $response = $this->delete(route('cliente.destroy', ['uuid' => $cliente->uuid]));
      $response->assertStatus(200);
      $this->assertEquals(__('response.delete.success'), $response->json('message'));
    }
}
