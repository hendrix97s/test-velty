<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory, Uuid;

    protected $with = [
      'fotos',
    ];

    protected $fillable = [
      'nome',
      'numero', 
      'descricao', 
    ];

    protected $hidden = [
      'id',
      'tipagem_id',
      'created_at',
      'updated_at',
      'pivot'
    ];

    public function fotos()
    {
      return $this->belongsToMany(Foto::class)->using(FotoSala::class);
    }

}
