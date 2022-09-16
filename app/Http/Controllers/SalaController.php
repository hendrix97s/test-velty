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

    public function listFotos($uuid, SalaRepository $repository)
    {
      $fotos = $repository->findByUuid($uuid);

      if($fotos){
        $fotos->makeVisible(['fotos']);
        $fotos = $fotos->fotos;
      }
      
      return $this->response('response.list', $fotos);
    }
}
