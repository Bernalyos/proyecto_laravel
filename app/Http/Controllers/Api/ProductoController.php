<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Http\Requests\ProductoRequest;
use App\Http\Resources\ProductoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return ProductoResource::collection($productos);
    }

    public function store(ProductoRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $data['imagen_url'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto = Producto::create($data);
        return new ProductoResource($producto->load('categoria'));
    }

    public function show(Producto $producto)
    {
        return new ProductoResource($producto->load('categoria'));
    }

    public function update(ProductoRequest $request, Producto $producto)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            if ($producto->imagen_url) {
                Storage::disk('public')->delete($producto->imagen_url);
            }
            $data['imagen_url'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($data);
        return new ProductoResource($producto->load('categoria'));
    }

    public function destroy(Producto $producto)
    {
        if ($producto->imagen_url) {
            Storage::disk('public')->delete($producto->imagen_url);
        }
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado con éxito'], 204);
    }
}
