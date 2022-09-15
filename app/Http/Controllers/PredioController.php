<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePredioRequest;
use App\Http\Requests\UpdatePredioRequest;
use App\Models\Predio;
use App\Repositories\ClienteRepository;
use App\Repositories\PredioRepository;

class PredioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid, PredioRepository $repository)
    {
      $predios = $repository->getPrediosByClienteUuid($uuid);
      return $this->response('response.list',$predios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePredioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePredioRequest $request, PredioRepository $repository)
    {
      $data = $request->validated();
      $cliente = (new ClienteRepository())->findByUuid($request->uuid);
      $data['cliente_id'] = $cliente->id;
      $predio = $repository->create($data);
      return $this->response('response.create', $predio);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Predio  $predio
     * @return \Illuminate\Http\Response
     */
    public function show($uuid, PredioRepository $repository)
    {
      $predio = $repository->findByUuid($uuid);
      if($predio instanceof Predio){
        $predio->makeVisible(['endereco']);
      }
      return $this->response('response.show', $predio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePredioRequest  $request
     * @param  \App\Models\Predio  $predio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePredioRequest $request, PredioRepository $repository)
    {
      $data = $request->validated();
      $predio = $repository->updateByUuid($request->uuid, $data);
      return $this->response('response.update', $predio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Predio  $predio
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid, PredioRepository $repository)
    {
      $predio = $repository->deleteByUuid($uuid);
      return $this->response('response.delete', $predio);
    }
}
