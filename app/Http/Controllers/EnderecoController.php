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
     * Cadastro de endereço
     * 
     * @group Endereço
     * @urlParam uuid required O uuid do Cliente ou Prédio. Example: 32a29cbe-6cae-45d8-b8b7-610baca99a3b
     * @bodyParam cep string required O CEP do endereço. Example: 13606-536
     * @bodyParam numero string required O número do endereço. Example: 123
     * @bodyParam complemento string O complemento do endereço. Example: Apto 123
     * @bodyParam tipo string required O tipo do recurso a ser utilizado (cliente ou predio). Example: cliente
     * 
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
     * @group Endereço
     * 
     * @urlParam uuid required O Uuid de um cliente. Example: 006902ab-ae1c-4315-aa5c-9edd856630ac
     * @urlParam endereco_uuid required O Uuid de um endereço. Example: 006902ab-ae1c-4315-aa5c-9edd856630ac
     * @bodyParam cep string CEP do endereço. Example: 12345678
     * @bodyParam numero string Número do endereço. Example: 123
     * @bodyParam complemento string Complemento do endereço. Example: casa
     * @bodyParam tipo required Tipo do recurso a ser utilizado (predio ou cliente). Example: cliente
     * @response {
     *  "status": true,
     *  "message": "Registro autalizado com sucesso",
     *  "data": {
     *    "uuid": "97a119a3-d55e-425c-ae70-f4ee78ddf30d",
     *    "cep": "13606-536",
     *    "logradouro": "Avenida Luiz Carlos Tunes",
     *    "numero": "123",
     *    "complemento": "predio",
     *    "bairro": "Jardim Morumbi",
     *    "cidade": "Araras",
     *    "uf": "SP",
     *    "url_google_maps": null
     *  }
     *}
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
     * Removendo o endereço de um cliente ou Prédio.
     * 
     * @group Endereço
     * 
     * @urlParam uuid required O Uuid de um cliente. Example: 4816ac45-f3d8-46ce-95b3-bb718689d7af 
     * @urlParam endereco_uuid required O Uuid de um endereço. Example: 4816ac45-f3d8-46ce-95b3-bb718689d7af
     * 
     * @response {
     *  "status": true,
     *  "message": "Registro removido com sucesso",
     *  "data": []
     *}
     *
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, EnderecoRepository $repository)
    {
      $response = $repository->deleteByUuid($request->endereco_uuid);
      return $this->response('response.destroy', $response);
    }
}
