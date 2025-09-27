<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            
            <footer class="bg-purple-800 text-purple-200" aria-labelledby="footer-heading">
                <h2 id="footer-heading" class="sr-only">Footer</h2>
                <div class="mx-auto max-w-7xl px-6 py-8 sm:py-12 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 items-center">
                        
                        <div class="flex justify-center md:justify-start">
                            <a href="/" class="flex items-center space-x-4">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="block h-12 rounded-full w-auto" />
                                <div class="text-left">
                                    <p class="font-bold text-white">UNIVERSITAS</p>
                                    <p class="font-semibold text-white">SINGAPERBANGSA</p>
                                    <p class="font-light text-white">KARAWANG</p>
                                </div>
                            </a>
                        </div>

                        <div class="text-center md:text-left">
                            <p class="text-sm leading-6">
                                Jl. HS. Ronggo Waluyo, Puseurjaya, Kec. Telukjambe Timur, Karawang, Jawa Barat, Indonesia 41361
                            </p>
                        </div>

                        <div class="text-center md:text-left">
                            <h3 class="font-semibold text-white">Kontak Kami:</h3>
                            <ul class="mt-2 space-y-1 text-sm">
                                <li>(0859) 121392342</li>
                                <li>+62 859121392342</li>
                            </ul>
                        </div>

                        <div class="text-center md:text-left">
                            <h3 class="font-semibold text-white">Office Hours:</h3>
                            <ul class="mt-2 space-y-1 text-sm">
                                <li>Senin - Kamis: 08.00-16.00</li>
                                <li>Jumat: 08.00-16.30</li>
                            </ul>
                        </div>

                    </div>
                    <div class="mt-12 border-t border-white/10 pt-8">
                        <p class="text-center text-xs leading-5">&copy; {{ date('Y') }} Balikin. Projek Framework Web.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>

