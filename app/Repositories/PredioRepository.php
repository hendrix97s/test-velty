<?php

namespace App\Repositories;

use App\Models\Predio;

class PredioRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Predio::class);
    }

    public function getPrediosByClienteUuid($uuid){
      $cliente = new ClienteRepository();
      $cliente = $cliente->findByUuid($uuid);
      if(!$cliente) abort(404);
      return $this->model->where('cliente_id', $cliente->id)->get();
    }
}

