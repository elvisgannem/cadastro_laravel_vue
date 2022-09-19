<?php

namespace App\Http\Controllers;

use App\Services\ProdutosService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutosController extends Controller
{
    public function __construct()
    {
    }

    public function get(int $id = null): JsonResponse
    {
        try {
            return response()->json(
                (new ProdutosService())->get($id)
                , 200);
        } catch (\Throwable $error) {
            return response()->json(['error' => 'Não foi possível obter o(s) produto(s)', 'error_msg' => $error->getMessage()], 400);
        }
    }

    public function create(Request $request): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'nome' => 'required',
            'cor' => 'required',
            'tamanho' => 'required',
            'valor' => 'required'
        ], [
            'required' => 'O :attribute é necessário'
        ]);

        if($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        try {
            return response()->json(
                (new ProdutosService())->create($request->all())
            , 201);
        } catch (\Throwable $error) {
            return response()->json(['error' => 'Não foi possível criar o produto', 'error_msg' => $error->getMessage()], 400);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $update = (new ProdutosService())->update($request->all(), $id);
            if(!$update) {
                return response()->json(['error' => 'Não foi possível editar o produto'], 400);
            }
            return response()->json((new ProdutosService())->get($id), 200);
        } catch (\Throwable $error) {
            return response()->json(['error' => 'Não foi possível editar o produto', 'error_msg' => $error->getMessage()], 400);
        }
    }
}
