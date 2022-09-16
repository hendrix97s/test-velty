<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FotoSala extends Pivot
{
    use HasFactory;

    protected $table = 'foto_sala';

    protected $fillable = [
      'sala_id', 
      'foto_id'
    ];
}
