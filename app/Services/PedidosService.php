<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;

class PedidosService
{
    public function __construct()
    {
    }

    public function get(int $id = null): Pedido|Collection|null
    {
        if($id) {
            return Pedido::where('id', $id)->first();
        }
        return Pedido::all();
    }

    public function create(array $settings): Pedido
    {
        return Pedido::create([
            'user_id' => $settings['user_id'],
            'codigo_pedido' => Uuid::uuid4(),
            'data_pedido' => Carbon::now()->format('Y-m-d H:i:s'),
            'observacao' => $settings['observacao'] ?? null,
            'forma_pagamento' => $settings['forma_pagamento'],
            'obj_pedidos' => json_encode($settings['pedidos'])
        ]);
    }

    public function update(array $settings, int $id): bool
    {
        if(isset($settings['pedidos'])) {
            $products_exists = $this->validateIfProductExists($settings['pedidos']);

            if(!$products_exists) {
                return false;
            }
            $settings['obj_pedidos'] = json_encode($settings['pedidos']);
            unset($settings['pedidos']);
        }
        return Pedido::where('id', $id)->update($settings);
    }

    public function delete(int $id): bool
    {
        return Pedido::where('id', $id)->delete();
    }

    public function validateIfClientExists(int $client_id): bool
    {
        return Cliente::where('id', $client_id)->count();
    }

    public function validateIfProductExists(array $products): bool
    {
        foreach ($products as $product) {
            $product = Produto::where('id', $product)->first();
            if(!$product) {
                return false;
            }
        }

        return true;
    }
}
