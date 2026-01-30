<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
<!-- NAVBAR -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <!-- Logo -->
            <h1 class="text-2xl font-bold text-blue-600">
                Tienda
            </h1>

            <!-- Botones -->
            <div class="flex items-center gap-3">
                <a
                    href="{{ route('producto.create') }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition"
                >
                    Crear Nuevo Producto
                </a>
            </div>

        </div>
    </nav>
    <h1 class="text-3xl font-bold mb-6 text-center">Productos</h1>


    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @foreach($productos as $producto)
        <!-- Producto -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            
            <div class="p-4">
                <h2 class="text-lg font-semibold">{{ $producto->nombre }}</h2>
                <p class="text-gray-600 text-sm mt-1">
                    <!-- Description not in DB, maybe add later or remove? Using generic text for now -->
                    Producto disponible.
                </p>

                <div class="flex justify-between items-center mt-4">
                    <span class="text-xl font-bold text-blue-600">${{ $producto->precio }}</span>
                    <span class="text-sm text-gray-500">Stock: {{ $producto->stock }}</span>
                </div>

                <div class="mt-4 flex gap-2">
                    <a href="{{ route('producto.show', $producto->id) }}" class="flex-1 bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition text-center">
                        Ver
                    </a>
                    <a href="{{ route('producto.edit', $producto->id) }}" class="flex-1 bg-yellow-500 text-white py-2 rounded-md hover:bg-yellow-600 transition text-center">
                        Editar
                    </a>
                   <form action="{{ route('producto.destroy', $producto->id) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Estás seguro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</body>
</html>
