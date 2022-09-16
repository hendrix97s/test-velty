<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class ViacepService {

  private static $endpoint = '/ws/{cep}/json/';

  public static function getAddress(string $cep):array
  {
    $endpoint = config('settings.url_base.viacep') . self::$endpoint;
    $uri = str_replace('{cep}', $cep, $endpoint);
    $response = Cache::get($cep, Http::get($uri));
    if($response->successful()) {
      return Arr::only($response->json(), ['cep', 'logradouro', 'complemento', 'bairro', 'localidade', 'uf']);
    }
  }
}