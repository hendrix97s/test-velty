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
     * Store a newly created resource in storage.
     *
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
     * Display the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
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
     * Remove the specified resource from storage.
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
