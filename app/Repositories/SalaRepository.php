<?php

namespace App\Repositories;

use App\Models\Sala;

class SalaRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Sala::class);
    }

    public function getSalasByPredioUuid(string $uuid)
    {
      $repository = new PredioRepository();
      $predio = $repository->findByUuid($uuid);
      return $this->model->where('predio_id', $predio->id)->get();
    }

    public function createByPredioUuidAndTipagemUuid(string $predioUuid, array $data)
    {
      $repository = new PredioRepository();
      $tipagemRepository = new TipagemRepository();

      $predio = $repository->findByUuid($predioUuid);
      $tipagem = $tipagemRepository->findByUuid($data['tipagem_uuid']);

      $data['predio_id'] = $predio->id;
      $data['tipagem_id'] = $tipagem->id;
      return $this->model->create($data);
    }
}

