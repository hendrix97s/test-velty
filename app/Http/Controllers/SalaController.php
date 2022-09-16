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
     * Listagem de salas relacionadas a um prédio
     * @group Sala
     * @urlParam uuid required uuid do prédio. Example: ac07ae3c-79aa-4460-bc17-1b9b5ae9be01
     * @response {
     *  "status": true,
     *  "message": "Listagem retornada com sucesso",
     *  "data": [
     *    {
     *      "uuid": "ac07ae3c-79aa-4460-bc17-1b9b5ae9be01",
     *      "nome": "Ms. Amina Mosciski",
     *      "numero": "67",
     *      "descricao": "Quisquam sed et optio. Eius sunt assumenda dolor eligendi magni unde quia. Quia quos exercitationem nihil iste dolorem in."
     *    },
     *    {
     *      "uuid": "2b9a49bb-cb1f-4a21-ab60-8fdc5c43a2d1",
     *      "nome": "Ines Raynor",
     *      "numero": "47",
     *      "descricao": "Possimus quaerat accusantium ad deleniti consectetur cumque. Debitis et aperiam beatae aliquid. Ex qui aperiam amet unde non."
     *    },
     *    {
     *      "uuid": "147fd51f-9683-4950-84fa-1eb5247bdc1a",
     *      "nome": "Raquel Weissnat",
     *      "numero": "38",
     *      "descricao": "Nobis consectetur hic dicta ut hic. Molestiae mollitia autem et sint veniam reprehenderit eaque. Quia sit dolore et voluptates ducimus. Debitis temporibus dolor voluptatem alias omnis et."
     *    }
     *  ]
     *}
     * @param string $uuid uuid do prédio
     * @return \Illuminate\Http\Response
     */
    public function index(string $uuid, SalaRepository $repository)
    {
        $salas = $repository->getSalasByPredioUuid($uuid);
        return $this->response('response.list', $salas);
    }

    /**
     * Store a newly created resource in storage.
     * Cadastrando um prédio relacionado a um cliente
     * 
     * @group Sala
     * 
     * @urlParam uuid required uuid do prédio. Example: ac07ae3c-79aa-4460-bc17-1b9b5ae9be01
     * @bodyParam nome string required Nome da sala. Example: Sala 1
     * @bodyParam numero string required Número da sala. Example: 1
     * @bodyParam descricao string required Descrição da sala. Example: Sala de reunião
     * @bodyParam tipagem_uuid string required Uuid da tipagem. Example: 2b9a49bb-cb1f-4a21-ab60-8fdc5c43a2d1
     * @response {
     *  "status": true,
     *  "message": "Registro cadastrado com sucesso",
     *  "data": {
     *    "nome": "Sala 1",
     *    "numero": 1,
     *    "descricao": "Sala 1",
     *    "uuid": "9bf7502d-a7ab-4874-9279-272bd2b8ff04"
     *  }
     *}
     * @param  StoreSalaRequest  $request
     * @param SalaRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalaRequest $request, SalaRepository $repository)
    {
      $sala = $repository->createByPredioUuidAndTipagemUuid($request->uuid, $request->validated());
      return $this->response('response.create', $sala);
    }
    
    /**
     * Retornando o registro de uma sala.
     * @group Sala
     * @urlParam uuid required uuid do prédio. Example: 746fe4d9-66de-4074-bf4b-077927164b03
     * @urlParam sala_uuid required uuid da sala. Example: 746fe4d9-66de-4074-bf4b-077927164b03
     * @response {
     *  "status": true,
     *  "message": "Registro encontrado com sucesso",
     *  "data": {
     *    "uuid": "02f26f7c-6ac4-4dbd-ab89-d87d1f3dd02e",
     *    "nome": "Dr. Donato Gerhold",
     *    "numero": "47",
     *    "descricao": "Magnam dolor vero culpa a. Praesentium sit totam unde aut et doloribus nam officiis. Sint et veritatis est qui velit dolor tempora. Nam dolor architecto atque tenetur commodi architecto."
     *  }
     *}
     * @param  Request $request
     * @param  SalaRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SalaRepository $repository)
    {
        $sala = $repository->findByUuid($request->sala_uuid);
        return $this->response('response.show', $sala);
    }

    /**
     * Atualização de registro de uma sala
     * 
     * @group Sala
     * 
     * @urlParam uuid required uuid do prédio. Example: ac07ae3c-79aa-4460-bc17-1b9b5ae9be01
     * @urlParam sala_uuid required uuid da sala. Example: 746fe4d9-66de-4074-bf4b-077927164b03
     * @bodyParam nome string Nome da sala. Example: Sala 1
     * @bodyParam numero string Número da sala. Example: 1
     * @bodyParam descricao string Descrição da sala. Example: Sala de reunião
      * @response {
     *  "status": true,
     *  "message": "Registro autalizado com sucesso",
     *  "data": {
     *    "uuid": "e9cb6c8b-496e-469b-8048-e38003afd846",
     *    "nome": "Sala updated",
     *    "numero": "5",
     *    "descricao": "Sala 5"
     *  }
     *}
     * @param  UpdateSalaRequest  $request
     * @param  SalaRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalaRequest $request, SalaRepository $repository)
    {
        $response = $repository->updateByUuid($request->sala_uuid, $request->validated());
        return $this->response('response.update', $response);
    }

    /**
     * Removendo o registro de uma sala
     * @group Sala
     * 
     * @urlParam uuid required O Uuid do predio. Example: 746fe4d9-66de-4074-bf4b-077927164b03 
     * @urlParam sala_uuid required O Uuid da sala. Example: 746fe4d9-66de-4074-bf4b-077927164b03
     * @response {
     *  "status": true,
     *  "message": "Registro removido com sucesso",
     *  "data": []
     *}
     *
     * @param  Request $request
     * @param  SalaRepository $repository
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
     * @group Foto
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
