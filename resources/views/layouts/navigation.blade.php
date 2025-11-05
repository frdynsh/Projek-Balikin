<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center">
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="block h-12 rounded-full w-auto" />
                    </a>
                </div>
                <div class="hidden md:block ml-4">
                    <div class="font-bold text-xl text-gray-800 dark:text-gray-200">BALIKIN</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Universitas Singaperbangsa Karawang</div>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="flex items-center space-x-4">
                    {{-- Tombol Profil Pengguna --}}
                    <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        @if (Auth::user()->profile_photo_path)
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}">
                        @else
                            <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-medium text-sm text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-xs text-gray-500 dark:text-gray-400">
                                @if(Auth::user()->nim)
                                    Mahasiswa
                                @else
                                    Pengguna
                                @endif
                            </div>
                        </div>
                    </a>
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

    <div class="bg-purple-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="hidden sm:flex h-12 items-center space-x-8">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'border-white text-white' : 'border-transparent text-purple-200 hover:text-white hover:border-white/70' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                    Beranda
                </a>

                <div class="relative">
                    <x-dropdown align="left" width="48" content-classes="py-1 bg-purple-700 rounded-md shadow-lg">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 {{ (request()->routeIs('lost-items.create') || request()->routeIs('found-items.create')) ? 'border-white text-white' : 'border-transparent text-purple-200 hover:text-white hover:border-white/70' }} text-sm font-medium transition">
                                <div>Lapor Barang</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <a href="{{ route('lost-items.create') }}" class="block w-full px-4 py-2 text-start text-sm leading-5 text-purple-100 hover:bg-purple-600 focus:outline-none focus:bg-purple-600 transition duration-150 ease-in-out">
                                Barang Hilang
                            </a>
                            <a href="{{ route('found-items.create') }}" class="block w-full px-4 py-2 text-start text-sm leading-5 text-purple-100 hover:bg-purple-600 focus:outline-none focus:bg-purple-600 transition duration-150 ease-in-out">
                                Barang Temuan
                            </a>
                        </x-slot>
                    </x-dropdown>
                </div>

                <a href="{{ route('lost-items.index') }}" class="{{ request()->routeIs('lost-items.index') || request()->routeIs('lost-items.show') ? 'border-white text-white' : 'border-transparent text-purple-200 hover:text-white hover:border-white/70' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                    Barang Hilang
                </a>
                <a href="{{ route('found-items.index') }}" class="{{ request()->routeIs('found-items.index') ? 'border-white text-white' : 'border-transparent text-purple-200 hover:text-white hover:border-white/70' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                    Barang Temuan
                </a>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('lost-items.index')" :active="request()->routeIs('lost-items.*')">
                {{ __('Barang Hilang') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('found-items.index')" :active="request()->routeIs('found-items.*')">
                {{ __('Barang Temuan') }}
            </x-responsive-nav-link>
        </div>

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