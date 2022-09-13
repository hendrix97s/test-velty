<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predio extends Model
{
    use HasFactory, Uuid;

    protected $appends = [
      'endereco',
      'cliente',
    ];
    
    protected $with = [
      'fotos',
      'salas',
    ];

    protected $fillable = [
      'nome',
      'descricao',
    ];

    protected $hidden = [
      'id',
      'cliente_id',
      'created_at',
      'updated_at',
      'pivot'
    ];

    public function fotos()
    {
      return $this->belongsToMany(Foto::class)->using(FotoPredio::class);
    }

    public function salas()
    {
      return $this->hasMany(Sala::class, 'predio_id', 'id');
    }

    public function getEnderecoAttribute()
    {
      return $this->belongsToMany(Endereco::class)->using(EnderecoPredio::class)->first();
    }

    public function getClienteAttribute()
    {
      return $this->hasOne(Cliente::class, 'id', 'cliente_id')->first();
    }



    
}
