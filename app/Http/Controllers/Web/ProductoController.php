<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function Producto()
    {
        $productos = Producto::with('categoria')->get();
        return view('producto.index', compact('productos'));
    }

    public function Create()
    {
        $categorias = Categoria::all();
        return view('producto.create', compact('categorias'));
    }

    public function Store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen_url'] = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create($data);

        return redirect()->route('producto.index');
    }

    public function Show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('producto.show', compact('producto'));
    }

    public function Edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('producto.edit', compact('producto', 'categorias'));
    }

    public function Update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $producto = Producto::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('imagen')) {
            if ($producto->imagen_url) {
                Storage::disk('public')->delete($producto->imagen_url);
            }
            $data['imagen_url'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($data);

        return redirect()->route('producto.index');
    }

    public function Destroy($id)
    {
        $producto = Producto::findOrFail($id);
        
        if ($producto->imagen_url) {
            Storage::disk('public')->delete($producto->imagen_url);
        }
        
        $producto->delete();

        return redirect()->route('producto.index');
    }
}
