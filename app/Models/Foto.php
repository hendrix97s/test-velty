<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
      'nome', 
      'descricao', 
      'url',
      'path'
    ];

    protected $hidden = [
      'id',
      'created_at', 
      'updated_at',
      'pivot'
    ];
}
