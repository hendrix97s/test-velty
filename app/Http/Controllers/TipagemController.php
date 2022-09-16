<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipagemRequest;
use App\Http\Requests\UpdateTipagemRequest;
use App\Models\Tipagem;
use App\Repositories\TipagemRepository;

class TipagemController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  TipagemRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function index(TipagemRepository $repository)
    {
        $tipagens = $repository->all();
        return $this->response('response.list',$tipagens);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipagemRequest  $request
     * @param  TipagemRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipagemRequest $request, TipagemRepository $repository)
    {
        $tipagem = $repository->create($request->all());
        return $this->response('response.store',$tipagem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipagemRequest  $request
     * @param  TipagemRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipagemRequest $request, TipagemRepository $repository)
    {
        $tipagem = $repository->updateByUuid($request->uuid, $request->validated());
        return $this->response('response.update',$tipagem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TipagemRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $uuid, TipagemRepository $repository)
    {
        $tipagem = $repository->deleteByUuid($uuid);
        return $this->response('response.destroy',$tipagem);
    }
}
