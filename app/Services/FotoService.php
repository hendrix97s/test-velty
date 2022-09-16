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
      if(isset($data['foto'])){
        $this->saveImage($data['tipo'], $data['foto'], $path, $url); 
        $data['url'] = $url;
        $data['path'] = $path;
      }

      $respository = new FotoRepository();
      $response = $respository->updateByUuid($uuid, $data);
      return $response ?? false;
    }

    public function createFotoPredio($uuid, $fotoId)
    {
      $predio = new PredioRepository();
      $predio = $predio->findByUuid($uuid);
      FotoPredio::create([
        'foto_id' => $fotoId,
        'predio_id' => $predio->id
      ]);
    }

    public function createFotoSala($uuid, $fotoId)
    {
      $sala = new SalaRepository();
      $sala = $sala->findByUuid($uuid);
      FotoSala::create([
        'foto_id' => $fotoId,
        'sala_id' => $sala->id
      ]);
    }

    private function saveImage($tipo, $image, &$path, &$url)
    {
      $path = Storage::disk('public')->putFile($tipo, $image); 
      $url = Storage::disk('public')->url($path);
    }
}