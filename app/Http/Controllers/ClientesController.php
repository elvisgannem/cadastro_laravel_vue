<?php

namespace App\Http\Controllers;

use App\Services\ClientesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    public function __construct()
    {
    }

    public function get(int $id = null): JsonResponse
    {
        try {
            return response()->json(
                (new ClientesService())->get($id)
            , 200);
        } catch (\Throwable $error) {
            return response()->json(['error' => 'Não foi possível obter o(s) cliente(s)', 'error_msg' => $error->getMessage()], 400);
        }
    }

    public function create(Request $request): JsonResponse
    {
       $validated = Validator::make($request->all(), [
            'nome' => 'required',
            'cpf' => 'required',
            'sexo' => 'required',
            'email' => 'required|email'
        ], [
            'required' => 'O :attribute é necessário',
            'email' => 'O email é incorreto'
       ]);

        if($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        try {
            return response()->json(
                (new ClientesService())->create($request->all())
            , 201);
        } catch (\Throwable $error) {
            return response()->json(['error' => 'Não foi possível criar o cliente', 'error_msg' => $error->getMessage()], 400);
        }
    }

    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $update = (new ClientesService())->update($request->all(), $id);
            if(!$update) {
                return response()->json(['error' => 'Não foi possível editar o cliente'], 400);
            }
            return response()->json((new ClientesService())->get($id), 200);
        } catch (\Throwable $error) {
            return response()->json(['error' => 'Não foi possível editar o cliente', 'error_msg' => $error->getMessage()], 400);
        }
    }
}
