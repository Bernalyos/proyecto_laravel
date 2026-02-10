<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-6 px-4">
            <a href="{{ route('categoria.index') }}" class="p-3 bg-white/5 rounded-xl text-gray-500 hover:text-white border border-white/10 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-black text-xl text-white uppercase tracking-tighter italic">
                    {{ __('Editar Estructura') }}
                </h2>
                <p class="text-[8px] text-indigo-500 font-black uppercase tracking-[0.4em] mt-1 italic">Colección: {{ $categoria->nombre }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#070707] min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/[0.03] backdrop-blur-3xl rounded-[3rem] border border-white/5 p-10 md:p-16 relative overflow-hidden shadow-2xl">
                
                <form action="{{ route('categoria.update', $categoria->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-10">
                        <div>
                            <label for="nombre" class="inline-block px-4 py-1.5 bg-white text-black rounded-full text-[8px] uppercase tracking-widest font-black mb-4 italic">Nombre de la Categoría</label>
                            <input id="nombre" name="nombre" type="text" value="{{ $categoria->nombre }}"
                                class="block w-full bg-white/5 border border-white/10 rounded-2xl text-white px-6 py-6 text-2xl font-black focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-gray-800 italic uppercase tracking-tighter"
                                required />
                        </div>

                        <div>
                            <label for="descripcion" class="inline-block px-4 py-1.5 bg-white text-black rounded-full text-[8px] uppercase tracking-widest font-black mb-4 italic">Descripción / Alcance</label>
                            <textarea id="descripcion" name="descripcion" 
                                class="block w-full bg-white/5 border border-white/10 rounded-2xl text-white px-6 py-6 text-sm font-bold focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-gray-800 italic h-40 resize-none font-bold italic line-clamp-3">
                                {{ $categoria->descripcion }}
                            </textarea>
                        </div>
                    </div>

                    <!-- Botonera -->
                    <div class="mt-20 pt-10 border-t border-white/5 flex items-center justify-between">
                         <p class="text-[7px] text-gray-700 font-black uppercase tracking-[0.5em] italic">Seguimiento ID: 0{{ $categoria->id }}</p>
                        
                        <div class="flex items-center gap-10">
                            <a href="{{ route('categoria.index') }}" class="text-[9px] text-gray-500 hover:text-white transition-colors font-black uppercase tracking-widest italic">Cancelar</a>
                            <button type="submit" class="px-14 py-5 bg-white text-black rounded-2xl font-black text-[9px] uppercase tracking-widest shadow-xl hover:bg-indigo-600 hover:text-white transition-all transform hover:scale-105 active:scale-95">
                                Guardar Cambios
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
