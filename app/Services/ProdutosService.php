<?php

namespace App\Services;

use App\Models\Produto;
use Ramsey\Uuid\Uuid;

class ProdutosService
{
    public function create(array $settings): Produto
    {
        return Produto::create([
            'codigo_produto' => Uuid::uuid4(),
            'nome' => $settings['nome'],
            'cor' => $settings['cor'],
            'tamanho' => $settings['tamanho'],
            'valor' => $settings['valor']
        ]);
    }
}
