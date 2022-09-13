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
    public function when_create_a_client()
    {
      $this->withoutExceptionHandling();


      $client = Cliente::factory()->create();

      $endereco = Endereco::factory()->create();

      $clientEndereco = ClienteEndereco::factory()->create([
        'cliente_id' => $client->id,
        'endereco_id' => $endereco->id,
      ]);

      $c = Cliente::find($client->id);
      dd($c->toArray());
    }
}
