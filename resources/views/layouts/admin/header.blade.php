<header class="h-16 text-lg font-bold text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-800 shadow-sm flex items-center justify-between px-6 ">
    <div class="pl-8">
        <span>Hai! Selamat Datang Admin!</span>
    </div>
    <div class="hidden sm:flex sm:items-center sm:ms-6">
        <div class="pr-8 flex items-center space-x-4">
            {{-- Tombol Profil Pengguna --}}
            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-1 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                <!-- Avatar Placeholder -->
                @if (Auth::user()->profile_photo_path)
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}">
                @else
                    <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold text-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <div class="font-medium text-sm text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-gray-500 dark:text-gray-400">
                        Administrator
                    </div>
                </div>
            </a>
        </div>
    </div>
</header>