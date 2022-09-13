<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cliente extends Model
{
    use HasFactory, Uuid;

    protected $appends = ['endereco'];

    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'telefone',
        'email',
        'inicio_atividade',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function getEnderecoAttribute()
    {
      return $this->belongsToMany(Endereco::class)->using(ClienteEndereco::class)->first();
    }

}
