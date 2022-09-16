<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repositories\ClienteRepository;

class ClienteController extends Controller
{
    /**
     * Listagem de clientes.
     * @group Cliente
     * @response {
     *   "status": true,
     *   "message": "Listagem retornada com sucesso",
     *   "data": [
     *     {
     *       "uuid": "e26e6e0c-b259-42ea-8699-711f0ef2728b",
     *       "razao_social": "Margie Jenkins Sr.",
     *       "nome_fantasia": "Earline Hyatt",
     *       "cnpj": "Johnathan Ledner Sr.",
     *       "email": "okon.doris@schmidt.org",
     *       "telefone": "+1 (520) 262-6602",
     *       "inicio_atividade": "1985-03-27",
     *       "endereco": null
     *     },
     *     {
     *       "uuid": "26a70a69-1e91-4b32-8c91-5d2ceca26141",
     *       "razao_social": "Alta Nicolas III",
     *       "nome_fantasia": "Tiffany Kohler",
     *       "cnpj": "Carlos Bosco DVM",
     *       "email": "nhowe@emmerich.com",
     *       "telefone": "1-484-677-1592",
     *       "inicio_atividade": "1974-11-04",
     *       "endereco": null
     *     }
     *   ]
     * }
     * @param  ClienteRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function index(ClienteRepository $repository)
    {
      $response = $repository->all();
      return $this->response('response.list', $response);
    }

    /**
     * Cadastrando um novo cliente.
     * 
     * @group Cliente
     * 
     * @bodyParam razao_social string required Razão social do cliente. Example: Luiz F. Lima
     * @bodyParam nome_fantasia string required string Nome fantasia do cliente. Example: lf system
     * @bodyParam cnpj string required string CNPJ do cliente. Example: 43897291000175
     * @bodyParam telefone string required string Telefone do cliente. Example: 11999999999
     * @bodyParam email string required string Email do cliente. Example: lf.system@outlook.com
     * @bodyParam inicio_atividade string required date Data de inicio de atividade. Example: 2021-10-29
     * @response {
     *  "status": true,
     *  "message": "Registro cadastrado com sucesso",
     *  "data": {
     *    "razao_social": "Luiz F. Lima",
     *    "nome_fantasia": "lf system",
     *    "cnpj": "43897291000175",
     *    "telefone": "11999999999",
     *    "email": "lf.system@outlook.com",
     *    "inicio_atividade": "2021-10-29",
     *    "uuid": "32a29cbe-6cae-45d8-b8b7-610baca99a3b",
     *    "endereco": null
     *  }
     *}
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
     * Retornando um cliente.
     * @urlParam uuid required O Uuid de um cliente. Example: 006902ab-ae1c-4315-aa5c-9edd856630ac
     * @group Cliente
     * @response {
     *  "status": true,
     *  "message": "Registro encontrado com sucesso",
     *  "data": {
     *    "uuid": "006902ab-ae1c-4315-aa5c-9edd856630ac",
     *    "razao_social": "Luella Satterfield",
     *    "nome_fantasia": "Clarabelle Sipes",
     *    "cnpj": "Evangeline Barrows",
     *    "email": "cameron.gleichner@cassin.com",
     *    "telefone": "+1.323.234.0959",
     *    "inicio_atividade": "1972-01-22",
     *    "endereco": null
     *  }
     *}
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
     * Atualizando o registro de um cliente.
     * 
     * @group Cliente
     * 
     * @urlParam uuid required O Uuid de um cliente. Example: 4816ac45-f3d8-46ce-95b3-bb718689d7af
     * @bodyParam razao_social string Razão social do cliente. Example: Luiz F. Lima
     * @bodyParam nome_fantasia string string Nome fantasia do cliente. Example: lf system
     * @bodyParam cnpj string string CNPJ do cliente. Example: 43897291000175
     * @bodyParam telefone string string Telefone do cliente. Example: 11999999999
     * @bodyParam inicio_atividade string date Data de inicio de atividade. Example: 2021-10-29
     * @response {
     * "status": true,
     * "message": "Registro autalizado com sucesso",
     * "data": {
     *   "uuid": "4816ac45-f3d8-46ce-95b3-bb718689d7af",
     *   "razao_social": "Luiz F. Lima updated",
     *   "nome_fantasia": "lf system",
     *   "cnpj": "43897291000175",
     *   "email": "ruben80@smitham.com",
     *   "telefone": "11999999999",
     *   "inicio_atividade": "2005-10-29",
     *   "endereco": null
     * }
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
     * Removendo um cliente.
     * @group Cliente
     * 
     * @urlParam uuid required O Uuid de um cliente. Example: 4816ac45-f3d8-46ce-95b3-bb718689d7af
     * @response {
     *  "status": true,
     *  "message": "Registro removido com sucesso",
     *  "data": []
     *}
     *
     * @param  ClienteRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClienteRepository $repository)
    {
      $response = $repository->deleteByUuid(request()->uuid);
      return $this->response('response.destroy', $response);
    }
}
