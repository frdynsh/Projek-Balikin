<x-guest-layout>
    <div class="w-full sm:max-w-md">
        <!-- Logo, Judul, dan Subjudul -->
        <div class="text-center">
            <a href="/" class="inline-block">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20 h-20 rounded-full fill-current text-gray-500" />
            </a>
            <h2 class="mt-6 text-2xl font-bold text-gray-800 dark:text-gray-200">
                Satu Langkah Lagi!
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan? Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkannya lagi.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mt-6 mb-4 font-medium text-sm text-green-600 dark:text-green-400 text-center">
                Link verifikasi baru telah berhasil dikirim ke alamat email Anda.
            </div>
        @endif

        {{-- Tata letak tombol diubah menjadi vertikal --}}
        <div class="mt-8 space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button class="w-full justify-center bg-purple-500 hover:bg-purple-800 focus:bg-purple-800 active:bg-purple-900 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:bg-purple-700 dark:active:bg-purple-800">
                    Kirim Ulang Email Verifikasi
                </x-primary-button>
            </form>

            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

