<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FotoPredio extends Pivot
{
    use HasFactory;

    protected $table = 'foto_predio';

    protected $fillable = [
      'predio_id', 
      'foto_id'
    ];
}
