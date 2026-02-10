<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Inventory Premium') }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .glass { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); }
        </style>
    </head>
    <body class="bg-[#050505] text-white min-h-screen flex flex-col items-center justify-center p-6 overflow-hidden relative">
        <!-- Background Orbs -->
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-blue-600/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-indigo-600/20 rounded-full blur-[120px]"></div>

        <div class="max-w-4xl w-full relative z-10">
            <!-- Header/Nav -->
            <div class="flex flex-col items-center text-center space-y-8">
                <div class="w-20 h-20 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-3xl p-4 shadow-2xl shadow-blue-500/20 mb-4 transform -rotate-6 hover:rotate-0 transition-transform duration-500">
                    <svg class="text-white w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-b from-white to-white/40 leading-tight">
                    Gestión de Inventario <br> de Siguiente Nivel
                </h1>
                
                <p class="text-gray-400 text-lg md:text-xl max-w-2xl font-light leading-relaxed">
                    Potencie su negocio con nuestra plataforma inteligente de control de productos y categorías. Elegante, rápida y segura.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 mt-12 w-full sm:w-auto items-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="group relative px-12 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1 transition-all duration-300">
                                <span class="relative z-10">Ir al Dashboard</span>
                                <div class="absolute inset-x-0 -bottom-px mx-auto h-px w-1/2 bg-gradient-to-r from-transparent via-white/50 to-transparent"></div>
                            </a>
                            
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-white text-[10px] uppercase tracking-[0.2em] font-bold transition-colors">
                                    Cerrar Sesión
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="px-12 py-4 bg-white text-black rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-gray-200 hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-white/5">
                                Iniciar Sesión
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-12 py-4 bg-white/5 border border-white/10 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-white/10 hover:-translate-y-1 transition-all">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <!-- Dashboard Preview (Decorative) -->
            <div class="mt-24 glass rounded-[40px] p-2 rotation-x-12 opacity-50 hidden md:block">
                <div class="bg-[#0a0a0a] rounded-[36px] h-48 flex items-center justify-center border border-white/5">
                    <div class="flex gap-4">
                        <div class="w-32 h-1 bg-white/5 rounded-full"></div>
                        <div class="w-16 h-1 bg-white/5 rounded-full"></div>
                        <div class="w-24 h-1 bg-white/5 rounded-full"></div>
                    </div>
                </div>
            </div>
            
            <p class="text-center mt-12 text-gray-600 text-[10px] uppercase tracking-[0.4em] font-black">
                Powering Modern Enterprises &bull; 2026
            </p>
        </div>
    </body>
</html>
