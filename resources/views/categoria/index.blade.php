<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-4">
            <div>
                <h2 class="font-black text-2xl text-white tracking-tighter uppercase italic">
                    {{ __('Categorías') }}
                </h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="h-px w-6 bg-indigo-500"></span>
                    <p class="text-[8px] text-gray-500 font-black uppercase tracking-[0.4em]">Inventory Hierarchy</p>
                </div>
            </div>
            
            <a href="{{ route('categoria.create') }}" class="group inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-indigo-700 transition-all duration-300 shadow-lg">
                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                Nueva Categoría
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#070707] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 p-5 bg-white/5 border border-indigo-500/20 text-indigo-400 rounded-2xl backdrop-blur-3xl flex items-center gap-3">
                    <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span>
                    <span class="text-[9px] font-black uppercase tracking-widest italic">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($categorias as $categoria)
                    <div class="flex flex-col bg-white/[0.03] backdrop-blur-md rounded-[2.5rem] p-8 border border-white/5 transition-all duration-500 hover:border-indigo-500/30 group h-full">
                        
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-indigo-600/10 rounded-2xl flex items-center justify-center text-indigo-400 border border-indigo-500/10 transition-transform group-hover:rotate-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>

                            <div class="flex gap-2 opacity-50 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('categoria.edit', $categoria->id) }}" class="p-2.5 bg-white/5 rounded-xl text-gray-500 hover:text-white transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('¿Eliminar categoría?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2.5 bg-white/5 rounded-xl text-gray-500 hover:text-rose-500 transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <h3 class="text-lg font-black text-white tracking-widest uppercase italic mb-3 group-hover:text-indigo-400 transition-colors">
                            {{ $categoria->nombre }}
                        </h3>
                        
                        <p class="text-[10px] text-gray-500 font-bold leading-relaxed italic line-clamp-3 mb-8">
                            {{ $categoria->descripcion ?: 'SIN DESCRIPCIÓN TÉCNICA.' }}
                        </p>

                        <div class="mt-auto flex items-center justify-between text-[7px] font-black uppercase tracking-[0.3em] text-gray-700">
                            <span>Index-0{{ $categoria->id }}</span>
                            <span class="flex items-center gap-1.5">
                                <span class="w-1 h-1 bg-indigo-500 rounded-full"></span>
                                Colección Activa
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($categorias->isEmpty())
                <div class="mt-12 py-20 bg-white/5 border border-white/10 rounded-[3rem] text-center">
                    <p class="text-[10px] text-gray-500 font-black uppercase tracking-[0.4em]">Sin categorías registradas</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
