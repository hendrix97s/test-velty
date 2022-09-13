<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoSala extends Model
{
    use HasFactory;

    protected $table = 'fotos_sala';

    protected $fillable = [
      'sala_id', 
      'foto_id'
    ];
}
