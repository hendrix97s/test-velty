<?php

namespace App\Observers;

use App\Models\Endereco;

class EnderecoObserver
{
    
  public function deleting(Endereco $endereco)
  {
      $endereco->clienteEndereco()->delete();
      $endereco->predioEndereco()->delete();
  }
}
