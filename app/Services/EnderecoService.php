<?php

namespace App\Services;

use App\Models\ClienteEndereco;
use App\Models\EnderecoPredio;
use App\Repositories\ClienteRepository;
use App\Repositories\EnderecoRepository;
use App\Repositories\PredioRepository;

class EnderecoService
{

  /**
   * Undocumented function
   *
   * @param string $uuid
   * @param array $data
   * @return array
   */
  public function store($uuid, $data)
  {
    $repository = new EnderecoRepository();
    $address = ViacepService::getAddress($data['cep']);
    $data['cidade'] = $address['localidade'];
    $data = [...$address, ...$data];
    $endereco = $repository->create($data);

    switch ($data['tipo']) {
      case 'predio':
        $this->createPredioEndereco($uuid, $endereco->id);
        break;

      case 'cliente':
        $this->createClienteEndereco($uuid, $endereco->id);
        break;
    }

    return $endereco ?? false;
  }


  /**
   * Undocumented function
   *
   * @param string $uuid
   * @param array $data
   * @return array
   */
  public function update($uuid, $data)
  {
    $repository = new EnderecoRepository();
    $address = ViacepService::getAddress($data['cep']);
    $data['cidade'] = $address['localidade'];
    $data = [...$address, ...$data];
    $endereco = $repository->updateByUuid($uuid, $data);
    return $endereco ?? false;
  }

  private function createClienteEndereco($uuid, $enderecoId)
  {
    $cliente = (new ClienteRepository())->findByUuid($uuid);
    ClienteEndereco::create([
      'cliente_id'  => $cliente->id,
      'endereco_id' => $enderecoId
    ]);
  }

  private function createPredioEndereco($uuid, $enderecoId)
  {
    $predio = (new PredioRepository())->findByUuid($uuid);
    EnderecoPredio::create([
      'predio_id'   => $predio->id,
      'endereco_id' => $enderecoId
    ]);
  }
}