<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'codigo_pedido',
        'data_pedido',
        'observacao',
        'forma_pagamento',
        'obj_pedidos',
    ];

    public function user()
    {
        return $this->belongsTo(Cliente::class, 'user_id');
    }
}
