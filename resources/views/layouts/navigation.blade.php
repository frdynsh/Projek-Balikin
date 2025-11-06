<nav x-data="{ open: false, dropdown: false }" 
     class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-transparent text-white transition duration-300">
    <div class="mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo + Brand -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/icon/logo.png') }}" alt="Logo" class="h-10 w-10 rounded-full">
                    <div class="hidden md:block">
                        <div class="font-bold text-xl text-purple-400">BALIKIN</div>
                        <div class="text-sm text-gray-300">Universitas Singaperbangsa Karawang</div>
                    </div>
                </a>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('dashboard') }}" 
                   class="{{ request()->routeIs('dashboard') ? 'text-purple-400 border-b-2 border-purple-400' : 'hover:text-purple-400' }} text-sm font-medium transition">
                    Beranda
                </a>

                <!-- Dropdown: Lapor Barang -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="inline-flex items-center text-sm font-medium hover:text-purple-400 transition">
                        <span>Lapor Barang</span>
                        <svg class="ml-1 h-4 w-4 transform transition-transform duration-200" 
                             :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" 
                             viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" 
                                  d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" 
                                  clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" 
                         x-transition 
                         class="absolute left-0 mt-2 w-48 bg-gray-900/90 border border-gray-700 rounded-lg shadow-lg py-1 z-50">
                        <a href="{{ route('lost-items.create') }}" 
                           class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Barang Hilang</a>
                        <a href="{{ route('found-items.create') }}" 
                           class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Barang Temuan</a>
                    </div>
                </div>

                <a href="{{ route('lost-items.index') }}" 
                   class="{{ request()->routeIs('lost-items.*') ? 'text-purple-400 border-b-2 border-purple-400' : 'hover:text-purple-400' }} text-sm font-medium transition">
                    Barang Hilang
                </a>

                <a href="{{ route('found-items.index') }}" 
                   class="{{ request()->routeIs('found-items.*') ? 'text-purple-400 border-b-2 border-purple-400' : 'hover:text-purple-400' }} text-sm font-medium transition">
                    Barang Temuan
                </a>
            </div>

            <!-- Right Side (Profile + Logout) -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 hover:bg-white/10 px-3 py-2 rounded-lg transition">
                    @if (Auth::user()->profile_photo_path)
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}">
                    @else
                        <div class="w-8 h-8 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <div class="font-medium text-sm">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-400">
                            {{ Auth::user()->nim ? 'Mahasiswa' : 'Pengguna' }}
                        </div>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-400 hover:underline">
                        Logout
                    </button>
                </form>
            </div>

            <!-- Mobile Button -->
            <div class="md:hidden">
                <button @click="open = !open" class="p-2 rounded-md hover:bg-white/10 transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'block': !open}" class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'block': open, 'hidden': !open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="md:hidden border-t border-white/20 bg-black/50 backdrop-blur-md">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('dashboard') }}" class="block text-gray-200 hover:text-purple-400">Beranda</a>
            <a href="{{ route('lost-items.index') }}" class="block text-gray-200 hover:text-purple-400">Barang Hilang</a>
            <a href="{{ route('found-items.index') }}" class="block text-gray-200 hover:text-purple-400">Barang Temuan</a>

            <div class="pt-2 border-t border-white/20">
                <div class="text-xs text-gray-400 uppercase">Lapor Barang</div>
                <a href="{{ route('lost-items.create') }}" class="block text-gray-200 hover:text-purple-400">Barang Hilang</a>
                <a href="{{ route('found-items.create') }}" class="block text-gray-200 hover:text-purple-400">Barang Temuan</a>
            </div>

            <div class="pt-3 border-t border-white/20">
                <a href="{{ route('profile.edit') }}" class="block text-gray-200 hover:text-purple-400">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block text-red-400 hover:underline mt-2">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>