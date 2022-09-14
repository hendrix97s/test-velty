<?php

namespace App\Repositories;

use App\Models\Predio;

class PredioRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Predio::class);
    }
}

