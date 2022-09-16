<?php

namespace Tests\Feature;

use App\Models\Foto;
use App\Models\FotoSala;
use App\Models\Predio;
use App\Models\Sala;
use App\Models\Tipagem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SalaTest extends TestCase
{
  use RefreshDatabase;


  /** @test */
  public function sala_index()
  {
    $this->withoutExceptionHandling();
    $predio = Predio::factory()->create();
    Sala::factory(3)->create([
      'predio_id' => $predio->id
    ]);

    $params = ['uuid' => $predio->uuid];
    $response = $this->get(route('sala.index', $params));
    $response->assertStatus(200);
    $response->assertJsonCount(3, 'data');
    $this->assertEquals(__('response.list.success'), $response->json('message'));
  }

  /** @test */
  public function sala_store()
  {
    $predio = Predio::factory()->create();
    $tipagem = Tipagem::factory()->create();
    
    $params = ['uuid' => $predio->uuid];
    $payload = [
      'nome' => 'Sala 1',
      'numero' => 1,
      'descricao' => 'Sala 1',
      'tipagem_uuid' => $tipagem->uuid,
    ];


    $response = $this->post(route('sala.store', $params), $payload);
    $response->assertStatus(200);
    $this->assertEquals(__('response.store.success'), $response->json('message'));
  }

  /** @test */
  public function sala_show()
  {
    $predio = Predio::factory()->create();
    $sala = Sala::factory()->create([
      'predio_id' => $predio->id
    ]);

    $params = ['uuid' => $predio->uuid, 'sala_uuid' => $sala->uuid];
    $response = $this->get(route('sala.show', $params));
    $response->assertStatus(200);
    $this->assertEquals(__('response.show.success'), $response->json('message'));
  }

  /** @test */
  public function sala_update()
  {
    $predio = Predio::factory()->create();
    $sala = Sala::factory()->create([
      'predio_id' => $predio->id
    ]);

    $params = ['uuid' => $predio->uuid, 'sala_uuid' => $sala->uuid];
    $payload = [
      'nome' => 'Sala updated',
      'numero' => 5,
      'descricao' => 'Sala 5',
    ];

    $response = $this->put(route('sala.update', $params), $payload);
    $response->assertStatus(200);
    $this->assertEquals(__('response.update.success'), $response->json('message'));
  }

  /** @test */
  public function sala_destroy()
  {
    $predio = Predio::factory()->create();
    $sala = Sala::factory()->create([
      'predio_id' => $predio->id
    ]);

    $params = ['uuid' => $predio->uuid, 'sala_uuid' => $sala->uuid];
    $response = $this->delete(route('sala.destroy', $params));
    $response->assertStatus(200);
    $this->assertEquals(__('response.destroy.success'), $response->json('message'));
    $this->assertNull(Sala::where('uuid', $sala->uuid)->first());
  }

  /** @test*/
  public function sala_foto_index()
  {
    $sala = Sala::factory()->create();
    $fotos = Foto::factory(3)->create()->pluck('id')->toArray();
    foreach ($fotos as $fotoId) {
      FotoSala::factory()->create(['sala_id' => $sala->id,'foto_id' => $fotoId,]);
    }

    $response = $this->get(route('sala.foto.index', ['uuid' => $sala->uuid]));
    $response->assertStatus(200);
    $response->assertJsonCount(3, 'data');
    $this->assertEquals(__('response.list.success'), $response->json('message'));
  }

  /** @test*/
  public function sala_foto_store()
  {
    $this->withoutExceptionHandling();
    
    $sala = Sala::factory()->create();
    $foto = UploadedFile::fake()->image('foto.jpg', 1000, 1000);

    $payload = [
      'nome' => 'foto test',
      'descricao' => 'description foto test',
      'foto' =>  $foto,
      'tipo' => 'sala',
    ];

    $response = $this->post(route('sala.foto.store', ['uuid' => $sala->uuid]), $payload);
    $response->assertStatus(200);
    $response->assertJsonCount(5, 'data');

    $this->assertEquals(__('response.create.success'), $response->json('message'));

    Storage::disk('public')->assertExists($response->json('data.path'));
  }

  /** @test*/
  public function sala_foto_update()
  {
    $this->withoutExceptionHandling();
    
    $sala = Sala::factory()->create();
    $foto = UploadedFile::fake()->image('foto.jpg', 1000, 1000);

    $payload = [
      'nome' => 'foto test',
      'descricao' => 'description foto test',
      'foto' =>  $foto,
      'tipo' => 'sala',
    ];

    $response = $this->post(route('sala.foto.store', ['uuid' => $sala->uuid]), $payload);
    $response->assertStatus(200);
    $response->assertJsonCount(5, 'data');
    $this->assertEquals(__('response.create.success'), $response->json('message'));
    Storage::disk('public')->assertExists($response->json('data.path'));

    $payload = [
      'nome' => 'foto test update',
      'descricao' => 'description foto test update',
      'tipo' => 'sala',
    ];

    $fotoUuid = $response->json('data.uuid');
    $params = ['uuid' => $sala->uuid, 'foto_uuid' => $fotoUuid];
    $response = $this->put(route('sala.foto.update', $params), $payload);

  $response->assertStatus(200);
    $response->assertJsonCount(5, 'data');
    $this->assertEquals(__('response.update.success'), $response->json('message'));
    Storage::disk('public')->assertExists($response->json('data.path'));
  }

  /** @test*/
  public function sala_foto_destroy()
  {
    // $this->withoutExceptionHandling();

    $sala = Sala::factory()->create();
    $foto = UploadedFile::fake()->image('foto.jpg', 1000, 1000);

    $payload = [
      'nome' => 'foto test',
      'descricao' => 'description foto test',
      'foto' =>  $foto,
      'tipo' => 'sala',
    ];

    $responseFoto = $this->post(route('sala.foto.store', ['uuid' => $sala->uuid]), $payload);
    $responseFoto->assertStatus(200);
    $responseFoto->assertJsonCount(5, 'data');

    $this->assertEquals(__('response.create.success'), $responseFoto->json('message'));
    Storage::disk('public')->assertExists($responseFoto->json('data.path'));

    $response = $this->delete(route('sala.foto.destroy', ['uuid' => $sala->uuid, 'foto_uuid' => $responseFoto->json('data.uuid')]));
    $response->assertStatus(200);
    $response->assertJsonCount(0, 'data');
    $this->assertEquals(__('response.delete.success'), $response->json('message'));
    $this->assertNull(Foto::find($responseFoto->json('data.id')));
  }
}
