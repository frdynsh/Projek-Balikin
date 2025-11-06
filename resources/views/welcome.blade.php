<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balikin - Platform Lost & Found Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0B0B1E] text-white font-sans">

    <!-- Navbar -->
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

            <div class="space-x-8 hidden md:flex">
                <a href="#" class="hover:text-purple-400">Beranda</a>
                <div x-data="{ open: false }" class="relative" x-cloak>
                    <button @click="open = !open" class="inline-flex items-center px-1 pt-1 border-b-2 
                        border-transparent text-white hover:text-purple-400 text-sm font-medium transition ease-in-out duration-150">
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
                        <a href="{{ route('login') }}"
                            class="block w-full px-4 py-2 text-start text-sm text-gray-300 hover:bg-gray-700">
                            Barang Hilang
                        </a>
                        <a href="{{ route('login') }}"
                            class="block w-full px-4 py-2 text-start text-sm text-gray-300 hover:bg-gray-700">
                            Barang Temuan
                        </a>
                    </div>
                </div>
                <a href="{{ route('login') }}" class="hover:text-purple-400">Barang Hilang</a>
                <a href="{{ route('login') }}" class="hover:text-purple-400">Barang Temuan</a>
            </div>

            <a href="{{ route('login') }}" class="text-sm font-medium hover:text-purple-400">Log in →</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative h-[100vh] flex flex-col items-center justify-center text-center px-6 md:px-20">
        <div class="absolute inset-0 bg-[url('images/bg.jpg')] bg-cover bg-center opacity-20"></div>

        <div class="relative z-10 max-w-3xl">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Kehilangan Barang <br> di Kampus?
            </h1>

            <p class="text-gray-300 mb-8 max-w-xl mx-auto">
                Jangan panik. "Balikin" membantumu menemukan kembali barang berhargamu dan melaporkan barang yang kamu temukan. Platform Lost & Found untuk seluruh warga kampus.
            </p>

            <div class="flex justify-center gap-4">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-lg font-semibold text-white">
                    Gabung Sekarang
                </a>
                <a href="{{ route('login') }}" class="px-6 py-3 border border-gray-500 hover:border-purple-500 rounded-lg font-semibold">
                    Lihat Barang Hilang
                </a>
            </div>
        </div>
    </section>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
