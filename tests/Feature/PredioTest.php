<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\EnderecoPredio;
use App\Models\Foto;
use App\Models\FotoPredio;
use App\Models\Predio;
use App\Models\Sala;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PredioTest extends TestCase
{

  use RefreshDatabase;

  /** @test */
  public function predio_index(){
        
    $cliente = Cliente::factory()->create();
    $predio = Predio::factory(3)->create([
      'cliente_id' => $cliente->id,
    ]);

    $endereco = Endereco::factory()->create();

    for($i = 0; $i < 3; $i++){
      EnderecoPredio::factory()->create([
        'predio_id' => $predio[$i]->id,
        'endereco_id' => $endereco->id,
      ]);
    }

    $response = $this->get(route('predio.index', ['uuid' => $cliente->uuid]));
    $response->assertStatus(200);
  }

  /** @test */
  public function predio_store()
  {
    $this->withoutExceptionHandling();
    $payload = [
      'nome' => 'Predio 1',
      'descricao' => 'Predio 1',
    ];

    $params = [
      'uuid' => Cliente::factory()->create()->uuid,
    ];

    $response = $this->post(route('predio.store', $params), $payload);
    $response->assertStatus(200);
    $response->assertJsonCount(3, 'data');
    $this->assertEquals(__('response.create.success'), $response->json('message'));
  }

  /** @test */
  public function predio_show(){
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

    $response = $this->get(route('predio.show', ['uuid' => $predio->uuid]));
    $response->assertStatus(200);
    $response->assertJsonCount(4, 'data');
    $response->assertJsonCount(9, 'data.endereco');
  }

  /** @test */
  public function predio_update(){
    $this->withoutExceptionHandling();
    $payload = [
      'nome' => 'Predio updated',
      'descricao' => 'Predio updated',
    ];

    $predio = Predio::factory()->create();

    $response = $this->put(route('predio.update', ['uuid' => $predio->uuid]), $payload);
    $response->assertStatus(200);
    $response->assertJsonCount(3, 'data');
    $this->assertEquals(__('response.update.success'), $response->json('message'));
  }

  /** @test */
  public function predio_destroy(){
    $this->withoutExceptionHandling();
    $predio = Predio::factory()->create();

    $response = $this->delete(route('predio.destroy', ['uuid' => $predio->uuid]));
    $response->assertStatus(200);
    $this->assertEquals(__('response.delete.success'), $response->json('message'));
  }

  /** @test*/
  public function predio_endereco_store()
  {

    $predio = Predio::factory()->create();
    
    $payload = [
      'cep'         => '13606-536',
      'numero'      => '123',
      'complemento' => 'predio',
      'tipo'        => 'predio',
    ];

    $response = $this->post(route('predio.endereco.store', ['uuid' => $predio->uuid]), $payload);
    $response = $this->get(route('predio.show', ['uuid' => $predio->uuid]));
    $response->assertStatus(200);
    $response->assertJsonCount(9, 'data.endereco');
    $response->assertJsonCount(4, 'data');
    $this->assertEquals(__('response.show.success'), $response->json('message'));
  }

  /** @test */
  public function predio_endereco_update()
  {
    $predio = predio::factory()->create();
    
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

    $payload = [
      'cep'         => '13606-536',
      'numero'      => '123',
      'complemento' => 'predio',
      'tipo'        => 'predio',
    ];

    $enderecoUuid = $response->json('data.uuid');
    $params = ['uuid' => $predio->uuid, 'endereco_uuid' => $enderecoUuid];
    $response = $this->put(route('predio.endereco.update', $params), $payload);

    $response->assertStatus(200);
    $response->assertJsonCount(9, 'data');
    $this->assertEquals(__('response.update.success'), $response->json('message'));

    $response = $this->get(route('predio.show', ['uuid' => $predio->uuid]));
    $response->assertStatus(200);
    $response->assertJsonCount(9, 'data.endereco');
    $response->assertJsonCount(4, 'data');
    $this->assertEquals(__('response.show.success'), $response->json('message'));
  }

  /** @test */
  public function predio_endereco_destroy()
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

    $response = $this->delete(route('predio.endereco.destroy', ['uuid' => $predio->uuid, 'endereco_uuid' => $response->json('data.uuid')]));
    $response->assertStatus(200);
    $response->assertJsonCount(0, 'data');
    $this->assertEquals(__('response.delete.success'), $response->json('message'));
  }

  /** @test*/
  public function predio_foto_index()
  {

    $predio = Predio::factory()->create();

    FotoPredio::factory(3)->create([
      'predio_id' => $predio->id,
    ]);

    $response = $this->get(route('predio.foto.index', ['uuid' => $predio->uuid]));
    $response->assertStatus(200);
    $response->assertJsonCount(3, 'data');
    $this->assertEquals(__('response.list.success'), $response->json('message'));
  }

  /** @test*/
  public function predio_foto_store()
  {
    $this->withoutExceptionHandling();
    
    $predio = Predio::factory()->create();
    $foto = UploadedFile::fake()->image('foto.jpg', 1000, 1000);

    $payload = [
      'nome' => 'foto test',
      'descricao' => 'description foto test',
      'foto' =>  $foto,
      'tipo' => 'predio',
    ];

    $response = $this->post(route('predio.foto.store', ['uuid' => $predio->uuid]), $payload);
    $response->assertStatus(200);
    $response->assertJsonCount(5, 'data');

    $this->assertEquals(__('response.create.success'), $response->json('message'));

    Storage::disk('public')->assertExists($response->json('data.path'));
  }

  /** @test*/
  public function predio_foto_update()
  {
    $this->withoutExceptionHandling();
    
    $predio = Predio::factory()->create();
    $foto = UploadedFile::fake()->image('foto.jpg', 1000, 1000);

    $payload = [
      'nome' => 'foto test',
      'descricao' => 'description foto test',
      'foto' =>  $foto,
      'tipo' => 'predio',
    ];

    $response = $this->post(route('predio.foto.store', ['uuid' => $predio->uuid]), $payload);
    $response->assertStatus(200);
    $response->assertJsonCount(5, 'data');
    $this->assertEquals(__('response.create.success'), $response->json('message'));
    Storage::disk('public')->assertExists($response->json('data.path'));

    $payload = [
      'nome' => 'foto test update',
      'descricao' => 'description foto test update',
      'tipo' => 'predio',
    ];

    $fotoUuid = $response->json('data.uuid');
    $params = ['uuid' => $predio->uuid, 'foto_uuid' => $fotoUuid];
    $response = $this->put(route('predio.foto.update', $params), $payload);

  $response->assertStatus(200);
    $response->assertJsonCount(5, 'data');
    $this->assertEquals(__('response.update.success'), $response->json('message'));
    Storage::disk('public')->assertExists($response->json('data.path'));
  }

  /** @test*/
  public function predio_foto_destroy()
  {
    $this->withoutExceptionHandling();

    $predio = Predio::factory()->create();
    $foto = UploadedFile::fake()->image('foto.jpg', 1000, 1000);

    $payload = [
      'nome' => 'foto test',
      'descricao' => 'description foto test',
      'foto' =>  $foto,
      'tipo' => 'predio',
    ];

    $responseFoto = $this->post(route('predio.foto.store', ['uuid' => $predio->uuid]), $payload);
    $responseFoto->assertStatus(200);
    $responseFoto->assertJsonCount(5, 'data');
    $this->assertEquals(__('response.create.success'), $responseFoto->json('message'));
    Storage::disk('public')->assertExists($responseFoto->json('data.path'));

    $response = $this->delete(route('predio.foto.destroy', ['uuid' => $predio->uuid, 'foto_uuid' => $responseFoto->json('data.uuid')]));
    $response->assertStatus(200);
    $response->assertJsonCount(0, 'data');
    $this->assertEquals(__('response.delete.success'), $response->json('message'));
    $this->assertNull(Foto::find($responseFoto->json('data.id')));
  }
}
