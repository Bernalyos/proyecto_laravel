<?php

use App\Http\Controllers\Web\ProductoController;
use App\Http\Controllers\Web\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('producto.index');
    })->name('dashboard');

    Route::get('/productos', [ProductoController::class,'Producto'] )->name('producto.index');

    Route::get('/productos/create',[ProductoController::class, 'Create'])->name('producto.create');
    Route::post('/productos', [ProductoController::class, 'Store'])->name('producto.store');

    Route::get('/productos/show/{id}', [ProductoController::class, 'Show'])->name('producto.show');

    Route::get('/productos/edit/{id}', [ProductoController::class, 'Edit'])->name('producto.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'Update'])->name('producto.update');

    Route::delete('/productos/{id}', [ProductoController::class, 'Destroy'])->name('producto.destroy');

    // Categorias
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categoria.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::get('/categorias/edit/{id}', [CategoriaController::class, 'edit'])->name('categoria.edit');
    Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');
});
