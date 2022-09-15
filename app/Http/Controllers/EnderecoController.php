<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnderecoRequest;
use App\Http\Requests\UpdateEnderecoRequest;
use App\Models\Endereco;
use App\Repositories\EnderecoRepository;
use App\Services\EnderecoService;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEnderecoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnderecoRequest $request, EnderecoService $service)
    {
      $data = $request->validated();
      $response = $service->store($request->uuid, $data);
      return $this->response('response.create', $response);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEnderecoRequest  $request
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnderecoRequest $request, EnderecoService $service)
    {
      $data = $request->validated();
      $response = $service->update($request->endereco_uuid, $data);
      return $this->response('response.update', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, EnderecoRepository $repository)
    {
      $response = $repository->deleteByUuid($request->endereco_uuid);
      return $this->response('response.delete', $response);
    }
}
