<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecoPredio extends Model
{
  use HasFactory;

  protected $table = 'endereco_predio';

  public function endereco(){
    
    return $this->belongsToMany(Endereco::class, 'client_endereco');
  }
}
