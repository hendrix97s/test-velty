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
        // $this->withoutExceptionHandling();
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
        dd($response->json());
        $response->assertStatus(400);
    }
}
