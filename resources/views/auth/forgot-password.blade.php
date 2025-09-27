<x-guest-layout>
    <div class="w-full sm:max-w-md">
        <!-- Logo, Judul, dan Subjudul -->
        <div class="text-center">
            <a href="/" class="inline-block">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20 h-20 rounded-full fill-current text-gray-500" />
            </a>
            <h2 class="mt-6 text-2xl font-bold text-gray-800 dark:text-gray-200">
                Lupa Password?
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Tidak masalah. Cukup beritahu kami alamat email Anda dan kami akan mengirimkan link untuk mengatur ulang password Anda.
            </p>
        </div>

        <div class="mt-8">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Alamat Email -->
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Tombol Kirim Link -->
                <div class="mt-6">
                    <x-primary-button class="w-full justify-center bg-purple-500 hover:bg-purple-800 focus:bg-purple-800 active:bg-purple-900 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:bg-purple-700 dark:active:bg-purple-800">
                        Kirim Link Reset Password
                    </x-primary-button>
                </div>

                <div class="text-center mt-6">
                    <a class="underline text-sm text-indigo-600 dark:text-indigo-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('login') }}">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
