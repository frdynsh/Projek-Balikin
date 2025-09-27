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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen lg:grid lg:grid-cols-2">
            
            <div class="hidden lg:flex items-center justify-center bg-white dark:bg-gray-900 p-12">
                <img src="{{ asset('images/ilustrasi-login.png') }}" alt="Ilustrasi Lost and Found" class="max-w-sm w-full">
            </div>

            <div class="flex flex-col justify-center items-center p-6 sm:p-12 w-full bg-white dark:bg-gray-900">
                {{-- Di sinilah konten dari login.blade.php atau register.blade.php akan dimasukkan --}}
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

