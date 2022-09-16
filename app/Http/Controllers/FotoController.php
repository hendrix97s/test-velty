<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFotoRequest;
use App\Http\Requests\UpdateFotoRequest;
use App\Models\Foto;
use App\Repositories\FotoRepository;
use App\Services\FotoService;
use Illuminate\Http\Request;

class FotoController extends Controller
{

    /**
     * Cadastrando a foto de um predio ou sala
     * 
     * @group Foto
     * 
     * @urlParam uuid required uuid do Sala ou Prédio. Example: 1436a969-96b1-4e70-976d-426601fc4d55
     * @bodyParam nome string required Nome da foto. Example: Foto 1 
     * @bodyParam descricao string required Descrição da foto. Example: Foto 1
     * @bodyParam foto file required Foto. 
     * @bodyParam tipo string required Tipo do recurso a ser utilizado (sala ou predio). Example: predio
     * @response {
     *  "status": true,
     *  "message": "Registro cadastrado com sucesso",
     *  "data": {
     *    "nome": "foto test",
     *    "descricao": "description foto test",
     *    "url": "http:\/\/localhost:9000\/storage\/predio\/bz4IxCtxyQF2oDR0xRJUtAbqaQI5FMsSSBUGo717.jpg",
     *    "path": "predio\/bz4IxCtxyQF2oDR0xRJUtAbqaQI5FMsSSBUGo717.jpg",
     *    "uuid": "46a3d089-dc55-4432-bf56-ea8f1f13fdc7"
     *  }
     *}
     * @param  \App\Http\Requests\StoreFotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFotoRequest $request, FotoService $service)
    {
      $data = $request->validated();

      $response = $service->store($request->uuid, $data);
      return $this->response('response.create', $response);
    }

    /**
     * Atualização de registro de uma foto
     * 
     * @group Foto
     * 
     * @urlParam uuid required O Uuid do Sala ou Prédio. Example: 746fe4d9-66de-4074-bf4b-077927164b03
     * @bodyParam nome string Nome da foto. Example: Foto 1 
     * @bodyParam descricao string Descrição da foto. Example: Foto 1
     * @bodyParam foto file Foto. 
     * @bodyParam tipo string Tipo do recurso a ser utilizado (sala ou predio). Example: predio
     * @response {
     *  "status": true,
     *  "message": "Registro cadastrado com sucesso",
     *  "data": {
     *    "nome": "foto test",
     *    "descricao": "description foto test",
     *    "url": "http:\/\/localhost:9000\/storage\/predio\/BFa2ZUoe0nABOm1qYlKoyRtviBS6LLf838Zv27yq.jpg",
     *    "path": "predio\/BFa2ZUoe0nABOm1qYlKoyRtviBS6LLf838Zv27yq.jpg",
     *    "uuid": "e3ee01d3-c66f-4e4f-aa0d-bfd6976fb622"
     *  }
     *}
     * @param  \App\Http\Requests\UpdateFotoRequest  $request
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFotoRequest $request, FotoService $service)
    {
      $data = $request->validated();
      $response = $service->update($request->foto_uuid, $data);
      return $this->response('response.update', $response);
    }

    /**
     * Removendo o registro de um prédio
     * @group Foto
     * 
     * @urlParam uuid required O Uuid do Prédio ou Sala. Example: 746fe4d9-66de-4074-bf4b-077927164b03
     * @urlParam foto_uuid required O Uuid da foto a ser removida. Example: 746fe4d9-66de-4074-bf4b-077927164b03
     * @response {
     *  "status": true,
     *  "message": "Registro removido com sucesso",
     *  "data": []
     *}
     *
     * @param string $uuid Foto uuid
     * @param FotoRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, FotoRepository $repository)
    {
      $response = $repository->deleteByUuid($request->foto_uuid);
      return $this->response('response.delete', $response);
    }
}
