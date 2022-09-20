<?php

namespace App\Services;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;

class ProdutosService
{

    public function get(int $id = null): Produto|Collection|null
    {
        if($id) {
            return Produto::where('id', $id)->first();
        }

        return Produto::all();
    }

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

    public function update(array $settings, int $id): bool
    {
        return Produto::where('id', $id)->update($settings);
    }

    public function delete(int $id): bool
    {
        return Produto::where('id', $id)->delete();
    }
}
