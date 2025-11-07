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
    </head>
    <body class="font-sans antialiased">

        <div class="flex h-screen bg-white dark:bg-gray-800">

            @include('layouts.admin.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">

                @include('layouts.admin.header')

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white dark:bg-gray-800 p-6 no-scrollbar">
                    
                    {{ $slot }}

                </main>

                
            </div>

        </div>

    </body>
</html>