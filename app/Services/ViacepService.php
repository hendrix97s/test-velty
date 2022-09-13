<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ViacepService {

  private static $endpoint = '/ws/{cep}/json/';

  public static function getAddress(string $cep)
  {
    self::validateCep($cep);
    $endpoint = config('settings.url_base.viacep') . self::$endpoint;
    $uri = str_replace('{cep}', $cep, $endpoint);
    return Cache::get($cep, Http::get($uri));
  }

  public static function validateCep(string $cep):void
  {
    if(!preg_match('/^[0-9]{5}-[0-9]{3}$/', $cep)){
      abort(400, 'CEP inválido');
    }
  }
}