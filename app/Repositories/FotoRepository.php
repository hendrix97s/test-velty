<?php

namespace App\Repositories;

use App\Models\Foto;

class FotoRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Foto::class);
    }
}

