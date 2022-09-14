<?php

namespace App\Repositories;

use App\Models\Sala;

class SalaRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Sala::class);
    }
}

