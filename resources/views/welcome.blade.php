<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Balikin - Platform Lost & Found Kampus</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Scripts (Penting untuk memuat CSS) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="bg-white dark:bg-gray-900">
            <header class="absolute inset-x-0 top-0 z-50">
                <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                    <div class="flex lg:flex-1">
                        <a href="/" class="-m-1.5 p-1.5 flex items-center space-x-2">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto rounded-full text-gray-800 dark:text-gray-200" />
                            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200">Balikin</span>
                        </a>
                    </div>
                    <div class="flex lg:flex-1 lg:justify-end space-x-6">
                        <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Login</a>
                        <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Register</a>
                    </div>
                </nav>
            </header>

            <!-- 2. Hero Section -->
            <div class="relative isolate px-6 pt-14 lg:px-8">
                {{-- Latar Belakang Gradien Abstrak --}}
                <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                </div>
                
                <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl">Kehilangan Barang di Kampus?</h1>
                        <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">Jangan panik. "Balikin" membantumu menemukan kembali barang berhargamu dan melaporkan barang yang kamu temukan. Platform Lost & Found untuk seluruh warga kampus.</p>
                        <div class="mt-10 flex items-center justify-center gap-x-6">
                            <a href="{{ route('register') }}" class="rounded-md bg-purple-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600">Gabung Sekarang</a>
                            <a href="{{ route('lost-items.index') }}" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Lihat Barang Hilang <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

