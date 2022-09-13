<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\ClienteEndereco;
use App\Models\Endereco;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function when_create_a_client_and_address()
    {
      $this->withoutExceptionHandling();

      $client = Cliente::factory()->create();
      $endereco = Endereco::factory()->create();

      ClienteEndereco::factory()->create([
        'cliente_id' => $client->id,
        'endereco_id' => $endereco->id,
      ]);

      $c = Cliente::find($client->id);

      $this->assertCount(10, $c->endereco->toArray());
      $this->assertEquals($c->endereco->cep, $endereco->cep);
    }
}
