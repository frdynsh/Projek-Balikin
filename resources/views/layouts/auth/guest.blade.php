<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Balikin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Efek blur latar belakang */
        .glass-bg {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            background: rgba(15, 15, 35, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="relative min-h-screen flex flex-col text-white font-sans overflow-x-hidden">

    <!-- Background image dengan overlay gelap -->
    <div class="absolute inset-0 bg-[url('{{ asset('images/bg.jpg') }}')] bg-cover bg-center">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <header class="absolute inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between px-10 py-6">
            <div class="text-2xl font-bold text-purple-400">
                <div class="flex lg:flex-1">
                    <a href="/" class="-m-1.5 p-1.5 flex items-center space-x-2">
                        <img src="{{ asset('images/icon/logo.png') }}" alt="Logo" class="h-10 w-auto rounded-full text-gray-800 dark:text-gray-200" />
                        <span class="font-bold text-xl text-gray-800 dark:text-gray-200">Balikin</span>
                    </a>
                </div>
            </div>

            <!-- Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}" class="hover:text-purple-400 transition">Beranda</a>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="inline-flex items-center text-gray-200 hover:text-purple-400 text-sm font-medium transition">
                        <span>Lapor Barang</span>
                        <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 
                                1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false"
                        class="absolute left-0 mt-2 w-48 bg-gray-800/90 border border-gray-700 rounded-md shadow-lg py-1">
                        <a href="{{ url('/') }}" class="block w-full px-4 py-2 text-sm text-gray-300 hover:bg-gray-700/70">
                            Barang Hilang
                        </a>
                        <a href="{{ url('/') }}" class="block w-full px-4 py-2 text-sm text-gray-300 hover:bg-gray-700/70">
                            Barang Temuan
                        </a>
                    </div>
                </div>

                <a href="{{ url('/') }}" class="hover:text-purple-400 transition">Barang Hilang</a>
                <a href="{{ url('/') }}" class="hover:text-purple-400 transition">Barang Temuan</a>
            </div>

            <!-- Auth Button (dinamis) -->
            <div>
                @if (Route::is('login'))
                    <a href="{{ route('register') }}" class="text-sm font-medium hover:text-purple-400 transition">
                        Register
                    </a>
                @elseif (Route::is('register'))
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:text-purple-400 transition">
                        Login
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:text-purple-400 transition">
                        Login
                    </a>
                @endif
            </div>
        </nav>
    </header>
            

    <!-- Page Content -->
    <main class="relative flex-grow flex items-center justify-center px-6 mt-32 z-10">
        <div class="glass-bg w-full max-w-md rounded-3xl p-8 shadow-xl">
            @yield('content')
        </div>
    </main>

</body>
</html>
