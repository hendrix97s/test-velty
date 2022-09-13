<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipagem extends Model
{
    use HasFactory, Uuid;

    protected $table = 'tipagem';

    protected $fillable = [
      'nome', 
      'preco',
      'descricao', 
    ];

    protected $hidden = [
      'id',
      'created_at', 
      'updated_at', 
    ];
}
