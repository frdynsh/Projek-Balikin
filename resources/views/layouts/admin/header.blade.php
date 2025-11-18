<header class="h-16 font-bold text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-800 shadow-sm">
    
    <div class="max-w-7xl mx-auto h-full flex items-center justify-between px-4 sm:px-6 lg:px-8">

        <div class="flex items-center">
            <button @click.stop="sidebarOpen = !sidebarOpen" 
                    class="md:hidden -ml-2 mr-2 p-1 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <div>
                <span class="text-sm md:text-lg">Hai! Selamat Datang Admin!</span>
            </div>
        </div>

        <div class="flex items-center sm:ms-6">
            <div class="flex items-center space-x-2 md:space-x-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 md:space-x-3 border border-gray-300 dark:border-gray-600 rounded-lg px-2 py-1 md:px-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    
                    @if (Auth::user()->profile_photo_path)
                        <img class="h-8 w-8 md:h-10 md:w-10 rounded-full object-cover" src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}">
                    @else
                        <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold text-base md:text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    
                    <div>
                        <div class="font-medium text-sm text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="hidden md:block font-medium text-xs text-gray-500 dark:text-gray-400">
                            Administrator
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
</header>