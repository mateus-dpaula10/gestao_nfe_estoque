<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'data',
        'chave_acesso',
        'valor_total',
        'descricao'
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class)->withPivot('quantidade')->withTimestamps();
    }

    public function outputs()
    {
        return $this->hasMany(ProdutoSaida::class);
    }
}
