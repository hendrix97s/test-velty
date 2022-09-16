<?php

namespace App\Observers;

use App\Models\Predio;

class PredioObserver
{
  public function deleting(Predio $predio)
  {
    $predio->salas()->delete();
    $predio->fotos()->delete();
    $predio->enderecos()->delete();
  }
}
