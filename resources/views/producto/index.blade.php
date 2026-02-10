<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-4">
            <div>
                <h2 class="font-black text-2xl text-white tracking-tighter uppercase italic">
                    {{ __('Catálogo') }}
                </h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="h-px w-6 bg-blue-500"></span>
                    <p class="text-[8px] text-gray-500 font-black uppercase tracking-[0.4em]">Premium Inventory</p>
                </div>
            </div>
            
            <a href="{{ route('producto.create') }}" class="group inline-flex items-center px-6 py-3 bg-white text-black rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-lg">
                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                Nuevo Producto
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#070707] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Grid - Usamos 4 columnas en desktop para que se vean más pequeñas y ordenadas -->
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($productos as $producto)
                    <div class="flex flex-col bg-white/[0.03] backdrop-blur-md rounded-[2rem] border border-white/5 overflow-hidden transition-all duration-500 hover:border-blue-500/30 group h-full">
                        
                        <!-- Miniatura de Imagen (Aspect Square para uniformidad) -->
                        <div class="relative aspect-square overflow-hidden bg-black/40">
                            @if($producto->imagen_url)
                                <img src="{{ asset('storage/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white/5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path>
                                    </svg>
                                </div>
                            @endif

                            <!-- Cat Badge -->
                            @if($producto->categoria)
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 bg-black/60 shadow-xl backdrop-blur-md text-white text-[7px] font-black uppercase tracking-widest rounded-lg border border-white/5">
                                        {{ $producto->categoria->nombre }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Información Simplificada -->
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-sm font-black text-white tracking-widest uppercase italic mb-1 line-clamp-1 group-hover:text-blue-400 transition-colors">
                                {{ $producto->nombre }}
                            </h3>
                            <p class="text-[9px] text-gray-500 font-bold uppercase tracking-tighter mb-4 italic">Ref: 00{{ $producto->id }}</p>

                            <div class="flex justify-between items-end mb-6">
                                <div class="flex flex-col">
                                    <span class="text-[7px] text-gray-600 font-black uppercase tracking-widest leading-none mb-1">Precio</span>
                                    <span class="text-lg font-black text-white italic tracking-tighter">${{ number_format($producto->precio, 2) }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[7px] text-gray-600 font-black uppercase tracking-widest leading-none mb-1 block">Existencias</span>
                                    <span class="text-xs font-black {{ $producto->stock > 5 ? 'text-blue-500' : 'text-rose-500' }} italic">
                                        {{ $producto->stock }}
                                    </span>
                                </div>
                            </div>

                            <!-- Acciones (Visibles siempre para evitar confusión) -->
                            <div class="mt-auto grid grid-cols-4 gap-2">
                                <a href="{{ route('producto.show', $producto->id) }}" class="col-span-2 flex items-center justify-center py-2.5 bg-white/5 border border-white/10 rounded-xl text-[8px] font-black uppercase tracking-widest text-gray-400 hover:text-white hover:bg-white/10 transition-all">
                                    Detalles
                                </a>
                                <a href="{{ route('producto.edit', $producto->id) }}" class="flex items-center justify-center bg-white/5 border border-white/10 rounded-xl text-gray-500 hover:text-blue-400 transition-all">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('producto.destroy', $producto->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar producto?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full h-full flex items-center justify-center p-2.5 bg-white/5 border border-white/10 rounded-xl text-gray-500 hover:text-rose-500 transition-all">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($productos->isEmpty())
                <div class="mt-12 py-20 bg-white/5 border border-white/10 rounded-[3rem] text-center">
                    <p class="text-[10px] text-gray-500 font-black uppercase tracking-[0.4em]">Sin productos registrados</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
