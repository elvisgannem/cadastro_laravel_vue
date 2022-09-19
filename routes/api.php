<?php

use App\Http\Controllers\ClientesController;
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
    Route::post('/', [ProdutosController::class, 'create']);
});
