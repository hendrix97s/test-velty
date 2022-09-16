<?php

namespace App\Repositories;

use App\Models\Endereco;

class EnderecoRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Endereco::class);
    }
}

