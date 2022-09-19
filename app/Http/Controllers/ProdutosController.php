<?php

namespace App\Http\Controllers;

use App\Services\ProdutosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutosController extends Controller
{
    public function __construct()
    {
    }

    public function create(Request $request)
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
}
