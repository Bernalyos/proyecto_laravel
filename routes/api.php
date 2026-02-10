<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ProductoController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categorias', CategoriaController::class);
    Route::apiResource('productos', ProductoController::class);
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
