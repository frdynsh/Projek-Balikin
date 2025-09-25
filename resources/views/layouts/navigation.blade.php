<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 shadow-sm">
    <!-- Bagian Atas: Logo, Judul, dan Profil Pengguna -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Sisi Kiri: Logo dan Judul Sistem -->
            <div class="flex items-center">
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-12 w-auto" />
                    </a>
                </div>
                <div class="hidden md:block ml-4">
                    <div class="font-bold text-xl text-gray-800 dark:text-gray-200">BALIKIN</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Universitas Singaperbangsa Karawang</div>
                </div>
            </div>

            <!-- Sisi Kanan: Profil Pengguna dan Logout -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="flex items-center space-x-4">
                    {{-- Tombol Profil Pengguna --}}
                    <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <!-- Avatar Placeholder -->
                        <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-medium text-sm text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-xs text-gray-500 dark:text-gray-400">
                                @if(Auth::user()->role === 'admin')
                                    Administrator
                                @elseif(Auth::user()->nim)
                                    Mahasiswa
                                @else
                                    Pengguna
                                @endif
                            </div>
                        </div>
                    </a>
                    <!-- Tombol Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="text-sm text-red-600 dark:text-red-400 hover:underline">
                            {{ __('Logout') }}
                        </a>
                    </form>
                </div>
            </div>

            <!-- Tombol Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- DIUBAH: Bagian Bawah: Menu Navigasi Utama (Warna Default) -->
    <div class="bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="hidden sm:flex h-12 items-center space-x-8">
                 <!-- Link Navigasi untuk Desktop -->
                 <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                    Beranda
                 </a>
                 
                 @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                        Manajemen User
                    </a>
                    <a href="{{ route('admin.validasi.index') }}" class="{{ request()->routeIs('admin.validasi.index') ? 'border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                        Validasi Laporan
                    </a>
                 @else
                    <a href="{{ route('lost-items.index') }}" class="{{ request()->routeIs('lost-items.*') ? 'border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                        Barang Hilang
                    </a>
                    <a href="{{ route('found-items.index') }}" class="{{ request()->routeIs('found-items.*') ? 'border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                        Barang Temuan
                    </a>
                 @endif
            </div>
        </div>
    </div>

    <!-- Menu Navigasi Responsif (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            
            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    {{ __('Manajemen User') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.validasi.index')" :active="request()->routeIs('admin.validasi.index')">
                    {{ __('Validasi Laporan') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('lost-items.index')" :active="request()->routeIs('lost-items.*')">
                    {{ __('Barang Hilang') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('found-items.index')" :active="request()->routeIs('found-items.*')">
                    {{ __('Barang Temuan') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Opsi Pengaturan Responsif -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

