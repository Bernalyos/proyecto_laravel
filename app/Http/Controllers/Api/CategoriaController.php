<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;
use App\Http\Resources\CategoriaResource;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount('productos')->get();
        return CategoriaResource::collection($categorias);
    }

    public function store(CategoriaRequest $request)
    {
        $categoria = Categoria::create($request->validated());
        return new CategoriaResource($categoria);
    }

    public function show(Categoria $categoria)
    {
        return new CategoriaResource($categoria->load('productos'));
    }

    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update($request->validated());
        return new CategoriaResource($categoria);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return response()->json(['message' => 'Categoría eliminada con éxito'], 204);
    }
}
