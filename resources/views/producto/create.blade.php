<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-6 px-4">
            <a href="{{ route('producto.index') }}" class="p-3 bg-white/5 rounded-xl text-gray-500 hover:text-white border border-white/10 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-black text-xl text-white uppercase tracking-tighter italic">
                    {{ __('Nuevo Registro') }}
                </h2>
                <p class="text-[8px] text-blue-500 font-black uppercase tracking-[0.4em] mt-1 italic">Catálogo Premium</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#070707] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/[0.03] backdrop-blur-3xl rounded-[3rem] border border-white/5 p-10 md:p-16 relative overflow-hidden shadow-2xl">
                
                <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <!-- Datos -->
                        <div class="space-y-8">
                            <div>
                                <label for="nombre" class="inline-block px-4 py-1.5 bg-white text-black rounded-full text-[8px] uppercase tracking-widest font-black mb-4 italic">Nombre del Producto</label>
                                <input id="nombre" name="nombre" type="text" 
                                    class="block w-full bg-white/5 border border-white/10 rounded-2xl text-white px-6 py-4 text-sm font-bold focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-gray-700 italic"
                                    placeholder="Nombre del artículo..." required autofocus />
                            </div>

                            <div>
                                <label for="categoria_id" class="inline-block px-4 py-1.5 bg-white text-black rounded-full text-[8px] uppercase tracking-widest font-black mb-4 italic">Categoría</label>
                                <select name="categoria_id" id="categoria_id" 
                                    class="block w-full bg-white/5 border border-white/10 rounded-2xl text-white px-6 py-4 text-sm font-bold focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all uppercase italic cursor-pointer">
                                    <option value="" class="bg-[#111] text-gray-500">Seleccionar...</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" class="bg-[#111] text-white">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label for="precio" class="inline-block px-4 py-1.5 bg-white text-black rounded-full text-[8px] uppercase tracking-widest font-black mb-4 italic">Precio (USD)</label>
                                    <input id="precio" name="precio" type="number" step="0.01" 
                                        class="block w-full bg-white/5 border border-white/10 rounded-2xl text-white px-6 py-4 text-lg font-black focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all italic"
                                        required />
                                </div>
                                <div>
                                    <label for="stock" class="inline-block px-4 py-1.5 bg-white text-black rounded-full text-[8px] uppercase tracking-widest font-black mb-4 italic">Existencias</label>
                                    <input id="stock" name="stock" type="number" 
                                        class="block w-full bg-white/5 border border-white/10 rounded-2xl text-white px-6 py-4 text-lg font-black focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all italic"
                                        required />
                                </div>
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div class="flex flex-col h-full">
                            <label class="inline-block px-4 py-1.5 bg-white text-black rounded-full text-[8px] uppercase tracking-widest font-black mb-4 italic w-fit">SUBIR ARCHIVO</label>
                            
                            <div x-data="{ photoPreview: null, currentPhoto: null }" class="relative flex-1 group min-h-[300px]">
                                <input type="file" name="imagen" class="hidden" x-ref="photo" 
                                    x-on:change="
                                        const reader = new FileReader();
                                        reader.onload = (e) => { photoPreview = e.target.result; };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                    " />
                                
                                <div class="w-full h-full bg-white/[0.03] rounded-[2.5rem] border-2 border-dashed border-white/20 flex flex-col items-center justify-center cursor-pointer hover:bg-white/[0.07] transition-all duration-500 relative overflow-hidden" 
                                    x-on:click.prevent="$refs.photo.click()">
                                    
                                    <div x-show="!photoPreview && !currentPhoto" class="text-center p-8">
                                        <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mb-4 mx-auto border border-white/10">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </div>
                                        <p class="text-[8px] text-gray-500 font-black uppercase tracking-widest italic">Seleccionar Visual</p>
                                    </div>

                                    <div x-show="photoPreview" class="absolute inset-0">
                                        <img x-bind:src="photoPreview" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <span class="px-4 py-2 bg-white text-black text-[8px] font-black uppercase tracking-widest rounded-full shadow-2xl">Cambiar</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botonera -->
                    <div class="mt-20 pt-10 border-t border-white/5 flex items-center justify-end gap-10">
                        <a href="{{ route('producto.index') }}" class="text-[9px] text-gray-500 hover:text-white transition-colors font-black uppercase tracking-widest italic">Cancelar</a>
                        <button type="submit" class="px-12 py-4 bg-white text-black rounded-2xl font-black text-[9px] uppercase tracking-widest shadow-xl hover:bg-blue-500 hover:text-white transition-all transform hover:scale-105 active:scale-95">
                            Guardar Registro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
