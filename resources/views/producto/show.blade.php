<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('producto.index') }}" class="p-2.5 bg-white dark:bg-[#111] rounded-full text-gray-400 hover:text-black dark:hover:text-white border border-gray-100 dark:border-white/5 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="font-extrabold text-xl text-gray-900 dark:text-white leading-tight tracking-tight italic uppercase">
                    {{ __('Ficha del Artículo') }}
                </h2>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('producto.edit', $producto->id) }}" class="inline-flex items-center px-6 py-2.5 bg-white text-black rounded-xl font-black text-xs uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all shadow-xl">
                    Editar Datos
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#020617] min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#001D3D] overflow-hidden shadow-[0_30px_90px_rgba(0,0,0,0.3)] sm:rounded-[3.5rem] border border-blue-500/20">
                <div class="flex flex-col lg:flex-row">
                    <!-- Galería de Imagen (Lateral) -->
                    <div class="lg:w-5/12 relative aspect-[3/4] lg:aspect-auto overflow-hidden bg-black/20 border-r border-blue-500/10">
                        @if($producto->imagen_url)
                            <img src="{{ asset('storage/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-blue-900">
                                <svg class="w-24 h-24 mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path>
                                </svg>
                                <span class="text-[10px] font-black uppercase tracking-[0.3em]">Sin Registro Visual</span>
                            </div>
                        @endif
                    </div>

                    <!-- Especificaciones y Acciones -->
                    <div class="lg:w-7/12 p-10 lg:p-20 flex flex-col justify-center bg-[#001D3D]">
                        <div class="mb-10">
                            @if($producto->categoria)
                                <span class="inline-block px-5 py-2 bg-blue-500/10 text-blue-400 text-[10px] font-black rounded-full shadow-sm mb-8 uppercase tracking-[0.25em] border border-blue-500/20">
                                    {{ $producto->categoria->nombre }}
                                </span>
                            @endif

                            <h1 class="text-5xl lg:text-6xl font-black text-white mb-8 leading-[0.9] tracking-tighter italic">
                                {{ $producto->nombre }}
                            </h1>

                            <p class="text-blue-200/60 text-lg leading-relaxed font-light max-w-lg italic">
                                "La distinción en cada detalle. Un producto diseñado para cumplir con los estándares globales más exigentes."
                            </p>
                        </div>

                        <!-- Panel de Datos Técnicos -->
                        <div class="grid grid-cols-2 gap-12 py-10 border-y border-blue-500/10 mb-10">
                            <div class="flex flex-col">
                                <span class="text-blue-400/50 text-[10px] font-black uppercase tracking-[0.2em] mb-4">Valor de Mercado</span>
                                <span class="text-5xl font-black text-white tracking-tighter underline decoration-blue-500/30 underline-offset-8">
                                    <span class="text-2xl mr-1 font-light opacity-40">$</span>{{ number_format($producto->precio, 2) }}
                                </span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-blue-400/50 text-[10px] font-black uppercase tracking-[0.2em] mb-4">Stock de Reserva</span>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-5xl font-black {{ $producto->stock > 5 ? 'text-white' : 'text-rose-400' }} tracking-tighter">
                                        {{ $producto->stock }}
                                    </span>
                                    <span class="text-xs font-bold text-blue-400/40 uppercase tracking-widest">Unidades</span>
                                </div>
                            </div>
                        </div>

                        <!-- Zonas de Peligro Refinadas -->
                        <div class="mt-8 border-t border-blue-500/10 pt-8">
                            <form action="{{ route('producto.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Desea retirar permanentemente este artículo?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="group flex items-center justify-center gap-2 w-full py-4 bg-rose-500/5 text-rose-400 font-black text-[9px] uppercase tracking-[0.3em] rounded-2xl border border-rose-500/20 hover:bg-rose-500 hover:text-white transition-all duration-300">
                                    <svg class="size-3 transition-transform group-hover:scale-90" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 12px; height: 12px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Retirar Registro
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <p class="text-center mt-10 text-gray-400 text-[9px] uppercase tracking-[0.5em] font-black opacity-30">
                Serie ID: {{ str_pad($producto->id, 6, '0', STR_PAD_LEFT) }} &bull; Authenticated View
            </p>
        </div>
    </div>
</x-app-layout>
