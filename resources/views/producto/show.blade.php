<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-600 px-6 py-4">
            <h1 class="text-white text-2xl font-bold">{{ $producto->nombre }}</h1>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 gap-6">
                 
                <!-- Details -->
                <div class="flex flex-col justify-center">
                    <div class="mb-4">
                        <span class="block text-gray-500 text-sm uppercase tracking-wide">Precio</span>
                        <span class="text-3xl font-bold text-gray-800">${{ $producto->precio }}</span>
                    </div>
                    
                    <div class="mb-6">
                        <span class="block text-gray-500 text-sm uppercase tracking-wide">Stock Disponible</span>
                        <span class="text-xl font-semibold text-gray-800">{{ $producto->stock }} unidades</span>
                    </div>
                    
                    <p class="text-gray-600 mb-6">
                        Aquí podría ir una descripción más detallada del producto si estuviera disponible en la base de datos.
                    </p>
                    
                    <div class="flex gap-3">
                         <a href="{{ route('producto.edit', $producto->id) }}" class="flex-1 bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition text-center shadow-sm">
                            Editar
                        </a>
                         <form action="{{ route('producto.destroy', $producto->id) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Estás seguro?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition shadow-sm">
                                Eliminar
                            </button>
                        </form>
                    </div>
                    <div class="mt-4">
                         <a href="{{ route('producto.index') }}" class="block w-full border border-gray-300 text-gray-600 px-4 py-2 rounded-md hover:bg-gray-50 transition text-center">
                            Volver al listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
