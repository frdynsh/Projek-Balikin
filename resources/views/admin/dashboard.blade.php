<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Selamat Datang, Admin! Anda berhasil masuk ke halaman khusus Admin.</h1>
                </div>
            </div>
            <div class="flex justify-center">
                {{-- Anda bisa mengganti URL gambar ini dengan ilustrasi lain yang Anda suka --}}
                <img src="{{ asset('images/ilustrasi-dashboard.png') }}" alt="Ilustrasi Lost and Found" class="max-w-sm w-full">
            </div>
        </div>
    </div>
</x-app-layout>