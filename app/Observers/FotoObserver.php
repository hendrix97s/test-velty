<?php

namespace App\Observers;

use App\Models\Foto;

class FotoObserver
{
  public function deleting(Foto $foto)
  {
      $foto->fotoSala()->delete();
      $foto->fotoPredio()->delete();
  }
}
