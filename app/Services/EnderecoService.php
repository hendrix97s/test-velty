<?php

namespace App\Services;

use App\Repositories\EnderecoRepository;

class EnderecoService
{
    public function store($data)
    {
      $repository = new EnderecoRepository();
      $address = ViacepService::getAddress($data['cep']);
      $data['cidade'] = $address['localidade'];
      unset($address['localidade']);
      $data = [...$address, ...$data];
      return $repository->create($data);
    }
}