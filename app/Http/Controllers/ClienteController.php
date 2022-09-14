<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repositories\ClienteRepository;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  ClienteRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function index(ClienteRepository $repository)
    {
      $response = $repository->all();
      return $this->response('response.list', $response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreClienteRequest  $request
     * @param  ClienteRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request, ClienteRepository $repository)
    {
        $data = $request->validated();
        $response = $repository->create($data);
        return $this->response('response.create', $response);
    }
    /**
     * Display the specified resource.
     * @param string $uuid
     * @param  ClienteRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid, ClienteRepository $repository)
    {
        $response = $repository->findByUuid($uuid);
        return $this->response('response.show', $response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateClienteRequest  $request
     * @param  ClienteRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, ClienteRepository $repository)
    {
       $data = $request->validated();
        $response = $repository->updateByUuid($request->uuid, $data);
        return $this->response('response.update', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ClienteRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClienteRepository $repository)
    {
      $response = $repository->deleteByUuid(request()->uuid);
      return $this->response('response.delete', $response);
    }
}
