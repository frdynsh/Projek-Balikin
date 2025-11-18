<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased">

        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-white dark:bg-gray-800">

            <div x-show="sidebarOpen" @click="sidebarOpen = false" 
                 class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity md:hidden" 
                 x-cloak>
            </div>

            @include('layouts.admin.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden relative z-10">

                @include('layouts.admin.header')

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white dark:bg-gray-800 p-6 no-scrollbar">
                    
                    {{ $slot }}

                </main>

            </div>

        </div>
        
    </body>
</html>