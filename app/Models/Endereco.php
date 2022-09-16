<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
  use HasFactory, Uuid;

  protected $fillable = [
    'cep',
    'logradouro',
    'numero',
    'complemento',
    'bairro',
    'cidade',
    'uf',
    'url_google_maps',
  ];

  protected $hidden = [
    'id',
    'created_at',
    'updated_at',
    'pivot'
  ];

  public function clienteEndereco()
  {
    return $this->hasMany(ClienteEndereco::class, 'endereco_id', 'id');
  }

  public function predioEndereco()
  {
    return $this->hasMany(EnderecoPredio::class, 'endereco_id', 'id');
  }

}
