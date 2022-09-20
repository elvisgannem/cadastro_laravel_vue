<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'clientes'], function () {
    Route::get('/', [ClientesController::class, 'get']);
    Route::get('/{id}', [ClientesController::class, 'get']);
    Route::post('/', [ClientesController::class, 'create']);
    Route::put('/{id}', [ClientesController::class, 'update']);
    Route::delete('/{id}', [ClientesController::class, 'delete']);
});

Route::group(['prefix' => 'produtos'], function () {
    Route::get('/', [ProdutosController::class, 'get']);
    Route::get('/{id}', [ProdutosController::class, 'get']);
    Route::post('/', [ProdutosController::class, 'create']);
    Route::put('/{id}', [ProdutosController::class, 'update']);
    Route::delete('/{id}', [ProdutosController::class, 'delete']);
});

Route::group(['prefix' => 'pedidos'], function () {
    Route::get('/', [PedidosController::class, 'get']);
    Route::get('/{id}', [PedidosController::class, 'get']);
    Route::post('/', [PedidosController::class, 'create']);
});
