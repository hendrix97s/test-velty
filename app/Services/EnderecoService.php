<?php

namespace App\Services;

class EnderecoService
{
    public function store($data, $model)
    {
      $address = ViacepService::getAddress($data['cep']);
      // "cep" => "13606-536"
      // "logradouro" => "Avenida Luiz Carlos Tunes"
      // "complemento" => "(Branco) - lado ímpar"
      // "bairro" => "Jardim Morumbi"
      // "localidade" => "Araras"
      // "uf" => "SP"
      // "ibge" => "3503307"
      // "gia" => "1820"
      // "ddd" => "19"
      // "siafi" => "6165"
      
        // $endereco = $model->endereco()->create($request->all());
        // return $endereco;
    }
}