<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sku',
        'preco_compra',
        'preco_venda',
        'descricao'
    ];

    public function notas()
    {
        return $this->belongsToMany(Nota::class)->withPivot('quantidade')->withTimestamps();
    }

    public function outputs()
    {
        return $this->hasMany(ProdutoSaida::class);
    }
}
