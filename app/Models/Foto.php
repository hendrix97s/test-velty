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

    public function fotoSala()
    {
      return $this->hasMany(FotoSala::class, 'foto_id', 'id');
    }
  
    public function fotoPredio()
    {
      return $this->hasMany(FotoPredio::class, 'foto_id', 'id');
    }
  
}
