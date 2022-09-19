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
}