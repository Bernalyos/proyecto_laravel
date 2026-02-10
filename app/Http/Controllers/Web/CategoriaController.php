<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categoria.index', compact('categorias'));
    }

    public function create()
    {
        return view('categoria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias',
            'descripcion' => 'nullable|string',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categoria.index')->with('success', 'Categoría creada con éxito');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categoria.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $id,
            'descripcion' => 'nullable|string',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());

        return redirect()->route('categoria.index')->with('success', 'Categoría actualizada con éxito');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categoria.index')->with('success', 'Categoría eliminada con éxito');
    }
}
