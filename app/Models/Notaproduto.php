<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notaproduto extends Model
{
    use HasFactory;

    protected $table = 'nota_produto';

    protected $fillable = [
        'produto_id',
        'nota_id',
        'quantidade'
    ];
}
