<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EnderecoPredio extends Pivot
{
  use HasFactory;

  protected $table = 'endereco_predio';
  protected $fillable = [
    'predio_id',
    'endereco_id',
  ];
}
