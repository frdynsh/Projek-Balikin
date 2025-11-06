<x-auth-layout>
    <div class="w-full sm:max-w-md">
        <!-- Logo, Judul, dan Subjudul -->
        <div class="text-center">
            <a href="/" class="inline-block">
               <img src="{{ asset('images/icon/logo.png') }}" alt="Logo" class="w-20 h-20 rounded-full fill-current text-gray-500" />
            </a>
            <h2 class="mt-6 text-2xl font-bold text-gray-800 dark:text-gray-200">
                Konfirmasi Akses
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Ini adalah area aman. Mohon konfirmasi password Anda sebelum melanjutkan.
            </p>
        </div>

        <div class="mt-8">
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Tombol Konfirmasi -->
                <div class="mt-6">
                    <x-primary-button class="w-full justify-center bg-purple-500 hover:bg-purple-800 focus:bg-purple-800 active:bg-purple-900 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:bg-purple-700 dark:active:bg-purple-800">
                        Konfirmasi
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-auth-layout>
