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
    'rua',
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

}
