<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoSaida extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'nota_id',
        'user_id',
        'quantidade'
    ];

    public function produto() 
    {
        return $this->belongsTo(Produto::class);
    }

    public function nota() 
    {
        return $this->belongsTo(Nota::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
