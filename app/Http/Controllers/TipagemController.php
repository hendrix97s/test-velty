<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipagemRequest;
use App\Http\Requests\UpdateTipagemRequest;
use App\Models\Tipagem;
use App\Repositories\TipagemRepository;

class TipagemController extends Controller
{
    /**
     * Listagem de tipagem de salas
     * @group Tipagem
     * @response {
     *  "status": true,
     *  "message": "Listagem retornada com sucesso",
     *  "data": [
     *    {
     *      "uuid": "162d1a32-74bf-4e39-b528-8f2ff4eff152",
     *      "nome": "Cali Schowalter",
     *      "descricao": "Qui blanditiis alias id porro omnis itaque laudantium. Et rerum in aperiam ea maiores nulla et. Voluptatem maxime qui maiores. Suscipit accusamus eum quia dolorem saepe et eos.",
     *      "preco": 417.76
     *    },
     *    {
     *      "uuid": "6d4fadb6-c385-4cbc-a161-6c9a91c5ed56",
     *      "nome": "Dr. Coby Harris",
     *      "descricao": "Et rerum aut est deserunt pariatur debitis asperiores. Et non qui voluptatem. Qui illum at assumenda minus nihil soluta.",
     *      "preco": 513.02
     *    },
     *    {
     *      "uuid": "ec84da4a-b8d9-4574-871c-202343271485",
     *      "nome": "Prof. Cesar Oberbrunner III",
     *      "descricao": "Est ipsa aut accusantium vero eaque omnis ullam. Ducimus nam quos dolor ab. Maxime hic dolorem asperiores laboriosam.",
     *      "preco": 332.79
     *    }
     *  ]
     *}
     * @param  TipagemRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function index(TipagemRepository $repository)
    {
        $tipagens = $repository->all();
        return $this->response('response.list',$tipagens);
    }

    /**
     * Cadastrando uma tipagem de sala
     * 
     * @group Tipagem
     * 
     * @bodyParam nome string required Nome da tipagem. Example: Sala de reunião
     * @bodyParam descricao string required Descrição da tipagem. Example: Sala de reunião para 10 pessoas
     * @bodyParam preco float required Preço da tipagem. Example: 100.00
     * @response {
     *  "status": true,
     *  "message": "Registro cadastrado com sucesso",
     *  "data": {
     *    "nome": "Tipagem Teste",
     *    "preco": 10,
     *    "descricao": "Descri\u00e7\u00e3o da tipagem teste",
     *    "uuid": "49a7fb54-9ef7-4559-8ec8-9e933eaad9b0"
     *  }
     *}
     * @param  StoreTipagemRequest  $request
     * @param  TipagemRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipagemRequest $request, TipagemRepository $repository)
    {
        $tipagem = $repository->create($request->all());
        return $this->response('response.create',$tipagem);
    }

    /**
     * Atualizando uma tipagem de sala
     * 
     * @group Tipagem
     * @urlParam uuid string required UUID da tipagem. Example: 49a7fb54-9ef7-4559-8ec8-9e933eaad9b0
     * @bodyParam nome string Nome da tipagem. Example: Sala de reunião
     * @bodyParam descricao string Descrição da tipagem. Example: Sala de reunião para 10 pessoas
     * @bodyParam preco float Preço da tipagem. Example: 100.00
     * @response {
     *  "status": true,
     *  "message": "Registro autalizado com sucesso",
     *  "data": {
     *    "uuid": "4d845a8f-aa41-4b81-85f9-78839a77167f",
     *    "nome": "Tipagem Teste",
     *    "descricao": "Descri\u00e7\u00e3o da tipagem teste",
     *    "preco": 10
     *  }
     *}
     * @param  UpdateTipagemRequest  $request
     * @param  TipagemRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipagemRequest $request, TipagemRepository $repository)
    {
        $tipagem = $repository->updateByUuid($request->uuid, $request->validated());
        return $this->response('response.update',$tipagem);
    }

    /**
     * Removendo o registro de uma tipagem de sala
     * @group Tipagem
     * 
     * @urlParam uuid required UUID da tipagem. Example: 49a7fb54-9ef7-4559-8ec8-9e933eaad9b0
     * @response {
     *  "status": true,
     *  "message": "Registro removido com sucesso",
     *  "data": []
     *}
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
