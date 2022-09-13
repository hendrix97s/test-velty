<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClienteEndereco extends Pivot
{
    use HasFactory;

    protected $table = 'cliente_endereco';
    protected $fillable = [
        'cliente_id',
        'endereco_id',
    ];



}
