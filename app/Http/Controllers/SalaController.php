<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalaRequest;
use App\Http\Requests\UpdateSalaRequest;
use App\Models\Sala;
use App\Repositories\SalaRepository;
use App\Repositories\TipagemRepository;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid, SalaRepository $repository)
    {
        $salas = $repository->getSalasByPredioUuid($uuid);
        return $this->response('response.list', $salas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreModuloSalaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalaRequest $request, SalaRepository $repository)
    {
      $sala = $repository->createByPredioUuidAndTipagemUuid($request->uuid, $request->validated());
      return $this->response('response.store', $sala);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SalaRepository $repository)
    {
        $sala = $repository->findByUuid($request->sala_uuid);
        return $this->response('response.show', $sala);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSalaRequest  $request
     * @param  \App\Models\sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalaRequest $request, SalaRepository $repository)
    {
        $response = $repository->updateByUuid($request->sala_uuid, $request->validated());
        return $this->response('response.update', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SalaRepository $repository)
    {
        $response = $repository->deleteByUuid($request->sala_uuid);
        return $this->response('response.destroy', $response);
    }

    /**
     * 
     * Listagem de fotos da sala
     * @group Fotos
     * 
     * @urlParam uuid required O Uuid da sala. Example: 746fe4d9-66de-4074-bf4b-077927164b03
     * @response {
     *  "status": true,
     *  "message": "Listagem retornada com sucesso",
     *  "data": [
     *    {
     *      "uuid": "8056d5b1-9440-4714-9513-ce9f7bf987b9",
     *      "url": "https:\/\/via.placeholder.com\/640x480.png\/00ffbb?text=cats+Faker+eaque",
     *      "path": "\/tmp\/fakerzPQd5C",
     *      "nome": "Miss Bridgette Wiegand DDS",
     *      "descricao": "Neque quisquam amet nostrum eos culpa unde dolor. Ipsa sequi eum laudantium. Iusto ipsam sapiente nisi veritatis maiores omnis et qui."
     *    },
     *    {
     *      "uuid": "87a06252-d370-4606-977a-61c66e6cc1a6",
     *      "url": "https:\/\/via.placeholder.com\/640x480.png\/00dd22?text=cats+Faker+et",
     *      "path": "\/tmp\/fakerzrVQzN",
     *      "nome": "Prof. Ellsworth Schowalter DVM",
     *      "descricao": "Delectus consequuntur et voluptatum maxime. Et quia voluptatem voluptas. Quas vel voluptatum atque reprehenderit."
     *    },
     *    {
     *      "uuid": "2bb22bf1-5050-468d-a02d-9d45a229e005",
     *      "url": "https:\/\/via.placeholder.com\/640x480.png\/000011?text=cats+Faker+omnis",
     *      "path": "\/tmp\/fakerRqcyRF",
     *      "nome": "Aryanna Murphy",
     *      "descricao": "Qui nesciunt eum consequatur et assumenda consectetur cum. Sunt magnam ad unde earum. Pariatur voluptatem velit et."
     *    }
     *  ]
     *}
     *
     * @param string $uuid
     * @param SalaRepository $repository
     * @return void
     */
    public function listFotos(string $uuid, SalaRepository $repository)
    {
      $fotos = $repository->findByUuid($uuid);

      if($fotos){
        $fotos->makeVisible(['fotos']);
        $fotos = $fotos->fotos;
      }
      
      return $this->response('response.list', $fotos);
    }
}
