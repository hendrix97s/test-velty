<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class ViacepService {

  private static $endpoint = '/ws/{cep}/json/';

  public static function getAddress(string $cep):array
  {
    self::validateCep($cep);
    $endpoint = config('settings.url_base.viacep') . self::$endpoint;
    $uri = str_replace('{cep}', $cep, $endpoint);
    $response = Cache::get($cep, Http::get($uri));
    if($response->successful()) {
      return Arr::only($response->json(), ['cep', 'logradouro', 'complemento', 'bairro', 'localidade', 'uf']);
    }
  }

  public static function validateCep(string $cep):void
  {
    if(!preg_match('/^[0-9]{5}-[0-9]{3}$/', $cep)){
      abort(400, 'CEP inválido');
    }
  }
}