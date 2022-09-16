<?php

namespace App\Repositories;

use App\Models\Tipagem;

class TipagemRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Tipagem::class);
    }
}

