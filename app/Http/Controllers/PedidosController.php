<?php

namespace App\Http\Controllers;

use App\Services\PedidosService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidosController extends Controller
{
    public function __construct()
    {
    }

    public function get(int $id = null): JsonResponse
    {
        try {
            return response()->json(
                (new PedidosService())->get($id)
            , 200);
        } catch (\Throwable $error) {
            return response()->json(['error' => 'Não foi possível obter o(s) pedido(s)', 'error_msg' => $error->getMessage()], 400);
        }
    }

    public function create(Request $request): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'user_id' => 'required',
            'forma_pagamento' => 'required',
            'pedidos' => 'required',
        ], [
            'required' => 'O :attribute é necessário',
        ]);

        if($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $pedidos_service = new PedidosService();
        try {
            $client_exists = $pedidos_service->validateIfClientExists($request->user_id);
            if(!$client_exists) {
                return response()->json(['error' => 'O cliente não existe'], 400);
            }
            $products_exists = $pedidos_service->validateIfProductExists($request->pedidos);
            if(!$products_exists) {
                return response()->json(['error' => 'O(s) produto(s) não existe(m)'], 400);
            }
            return response()->json(
                $pedidos_service->create($request->all())
            , 201);
        } catch (\Throwable $error) {
            return response()->json(['error' => 'Não foi possível criar o pedido', 'error_msg' => $error->getMessage()], 400);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $pedidos_service = new PedidosService();
            $update = $pedidos_service->update($request->all(), $id);
            if(!$update) {
                return response()->json(['error' => 'Não foi possível atualizar'], 400);
            }
            return response()->json($pedidos_service->get($id), 200);
        } catch (\Throwable $error) {
            return response()->json(['error' => 'Não foi possível editar o pedido', 'error_msg' => $error->getMessage()], 400);
        }
    }
}
