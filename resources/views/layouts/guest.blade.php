<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Balikin - Platform Lost & Found Kampus')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-[#0B0B1E] text-white font-sans relative overflow-x-hidden">

    <!-- Background Gambar & Overlay -->
    <div class="absolute inset-0 bg-[url('{{ asset('images/bg.jpg') }}')] bg-cover bg-center opacity-20"></div>

    <!-- Navbar -->
    <header class="absolute inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between px-10 py-6">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ asset('images/icon/logo.png') }}" alt="Logo" class="h-10 w-auto rounded-full" />
                    <span class="font-bold text-xl text-gray-100">Balikin</span>
                </a>
            </div>

            <!-- Menu -->
            <div class="hidden md:flex space-x-8">
                <a href="{{ url('/') }}" class="hover:text-purple-400">Beranda</a>

                <div x-data="{ open: false }" class="relative" x-cloak>
                    <button @click="open = !open" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-white hover:text-purple-400 text-sm font-medium transition ease-in-out duration-150">
                        <span>Lapor Barang</span>
                        <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 
                                1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        class="absolute left-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-md shadow-lg py-1">
                        <a href="{{ route('login') }}" class="block w-full px-4 py-2 text-start text-sm text-gray-300 hover:bg-gray-700">
                            Barang Hilang
                        </a>
                        <a href="{{ route('login') }}" class="block w-full px-4 py-2 text-start text-sm text-gray-300 hover:bg-gray-700">
                            Barang Temuan
                        </a>
                    </div>
                </div>

                <a href="{{ route('login') }}" class="hover:text-purple-400">Barang Hilang</a>
                <a href="{{ route('login') }}" class="hover:text-purple-400">Barang Temuan</a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-purple-400">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium hover:text-purple-400">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-medium hover:text-purple-400">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
    </header>

     <!-- Session Alert -->
    <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-lg px-4">
        {{-- Success --}}
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded shadow-md flex justify-between items-center mb-2" x-data="{ open: true }" x-show="open">
                <span>{{ session('success') }}</span>
                <button @click="open = false" class="ml-4 font-bold">&times;</button>
            </div>
        @endif

        {{-- Error dari session --}}
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded shadow-md flex justify-between items-center mb-2" x-data="{ open: true }" x-show="open">
                <span>{{ session('error') }}</span>
                <button @click="open = false" class="ml-4 font-bold">&times;</button>
            </div>
        @endif

        {{-- Error dari validasi Laravel --}}
        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded shadow-md flex justify-between items-center mb-2" x-data="{ open: true }" x-show="open">
                <ul class="list-disc ml-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button @click="open = false" class="ml-4 font-bold">&times;</button>
            </div>
        @endif
    </div>


    <!-- Konten Utama -->
    <main class="relative flex flex-col items-center justify-center min-h-screen px-6 md:px-20 z-10">
        @yield('content')
    </main>

</body>
</html>
