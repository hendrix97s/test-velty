<?php


namespace App\Services;

use App\Models\FotoPredio;
use App\Models\FotoSala;
use App\Repositories\FotoRepository;
use App\Repositories\PredioRepository;
use App\Repositories\SalaRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FotoService
{
    public function store($uuid, $data)
    {
      $this->saveImage($data['tipo'], $data['foto'], $path, $url); 
      $data['url'] = $url;
      $data['path'] = $path;
      
      $respository = new FotoRepository();
      $response = $respository->create($data);

      switch ($data['tipo']) {
        case 'sala':
          $this->createFotoSala($uuid, $response->id);
          break;
        
        case 'predio':
          $this->createFotoPredio($uuid, $response->id);
          break;
      }

      return $response ?? false;

    }

    public function update($uuid, $data)
    {
      
    }

    public function createFotoPredio($uuid, $fotoId)
    {
      $predio = new PredioRepository();
      $predio = $predio->findByUuid($uuid);
      FotoPredio::created([
        'foto_id' => $fotoId,
        'predio_id' => $predio->id
      ]);
    }

    public function createFotoSala($uuid, $fotoId)
    {
      $sala = new SalaRepository();
      $sala->findByUuid($uuid);
      FotoSala::created([
        'foto_id' => $fotoId,
        'sala_id' => $sala->id
      ]);
    }

    private function saveImage($tipo, $image, &$path, &$url)
    {
      // $path = $image->store('public/images/'.$tipo);
      $path = Storage::disk('public')->putFile('predios', $image); 
      $url = Storage::disk('public')->url($path);
      // $url = config('app.url').Storage::url($path);
    }
}