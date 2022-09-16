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
     * Listagem de prédios relacionado a um cliente
     * @group Prédio
     * @urlParam uuid required uuid do cliente. Example: 1436a969-96b1-4e70-976d-426601fc4d55
     * @response {
     *  "status": true,
     *  "message": "Listagem retornada com sucesso",
     *  "data": [
     *    {
     *      "uuid": "1436a969-96b1-4e70-976d-426601fc4d55",
     *      "nome": "Price Blanda",
     *      "descricao": "Qui laudantium eos asperiores rerum. Sapiente voluptatum ea tempore et pariatur dicta consequuntur. Rem ut voluptas et sunt."
     *    },
     *    {
     *      "uuid": "cd3aa9b8-51fb-4858-bb59-40dad883de83",
     *      "nome": "Emile Dooley",
     *      "descricao": "Fuga occaecati molestiae sequi quibusdam veritatis. Qui dolores sunt aut labore. Molestiae dignissimos inventore perferendis et qui."
     *    },
     *    {
     *      "uuid": "544d13f4-7b1b-46e0-aa9d-e30c54b2a286",
     *      "nome": "Devon Feil",
     *      "descricao": "Deleniti sint quia veritatis asperiores quisquam aut. Numquam pariatur expedita voluptas voluptas soluta. Molestiae est perferendis ipsa et."
     *    }
     *  ]
     *}
     * @param  string $uuid uuid do cliente
     * @param  PredioRepository  $repository
     * @return \Illuminate\Http\Response
     */
    public function index(string $uuid, PredioRepository $repository)
    {
      $predios = $repository->getPrediosByClienteUuid($uuid);
      return $this->response('response.list',$predios);
    }

    /**
     * Cadastrando um prédio relacionado a um cliente
     * 
     * @group Prédio
     * 
     * @urlParam uuid required uuid do cliente. Example: 1436a969-96b1-4e70-976d-426601fc4d55
     * @bodyParam nome string required Nome do prédio. Example: Prédio 1
     * @bodyParam descricao string required Descrição do prédio. Example: Prédio 1
     * @response {
     *    "status": true,
     *    "message": "Registro cadastrado com sucesso",
     *    "data": {
     *      "nome": "Predio 1",
     *      "descricao": "Predio 1",
     *      "uuid": "cecd43a5-46a6-44f6-a016-584a88e264e2"
     *    }
     *  }
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
     * Retornando o registro de um prédio.
     * @group Prédio
     * @urlParam uuid required uuid do prédio. Example: 746fe4d9-66de-4074-bf4b-077927164b03
     * @response {
     *  "status": true,
     *  "message": "Registro encontrado com sucesso",
     *  "data": {
     *    "uuid": "746fe4d9-66de-4074-bf4b-077927164b03",
     *    "nome": "Rogers Crist",
     *    "descricao": "Iure labore odit sint ipsa quo. Laboriosam corrupti et deserunt id quisquam. Et est ad a quidem.",
     *    "endereco": {
     *      "uuid": "892f84b8-7761-4ff0-b50b-03928e76812d",
     *      "cep": "66599",
     *      "logradouro": "",
     *      "numero": "78394",
     *      "complemento": "Suite 357",
     *      "bairro": "side",
     *      "cidade": "Erdmanberg",
     *      "uf": "ND",
     *      "url_google_maps": ""
     *    }
     *  }
     *}
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
     * Atualização de registro de um prédio
     * 
     * @group Prédio
     * 
     * @urlParam uuid required O Uuid do predio. Example: 746fe4d9-66de-4074-bf4b-077927164b03
     * @bodyParam nome string required Nome do prédio. Example: Prédio 1 Updated
     * @bodyParam descricao string required Descrição do prédio. Example: Prédio 1 Updated
     * @response {
     *  "status": true,
     *  "message": "Registro autalizado com sucesso",
     *  "data": {
     *    "uuid": "a36b1b02-38b0-4a00-916b-fbb306ead110",
     *    "nome": "Predio updated",
     *    "descricao": "Predio updated"
     *  }
     *}
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
     * Removendo o registro de um prédio
     * @group Prédio
     * 
     * @urlParam uuid required O Uuid do predio. Example: 746fe4d9-66de-4074-bf4b-077927164b03 
     * @response {
     *  "status": true,
     *  "message": "Registro removido com sucesso",
     *  "data": []
     *}
     *
     * @param  \App\Models\Predio  $predio
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid, PredioRepository $repository)
    {
      $predio = $repository->deleteByUuid($uuid);
      return $this->response('response.destroy', $predio);
    }

    /**
     * Listagem de fotos do prédio
     * @group Foto
     * 
     * @urlParam uuid required O Uuid do prédio. Example: 746fe4d9-66de-4074-bf4b-077927164b03
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
     * @param PredioRepository $repository
     * @return void
     */
    public function listFotos(string $uuid, PredioRepository $repository)
    {
      $fotos = $repository->findByUuid($uuid);
      if($fotos){
        $fotos->makeVisible(['fotos']);
        $fotos = $fotos->fotos;
      }
      return $this->response('response.list', $fotos);
    }
}
