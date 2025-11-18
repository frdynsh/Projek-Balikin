<aside 
    class="w-64 h-full bg-white dark:bg-gray-800 text-gray-800 dark:text-white flex flex-col border-r border-gray-200 dark:border-gray-700
           fixed inset-y-0 left-0 z-30
           transform -translate-x-full transition-transform duration-300
           md:relative md:translate-x-0 md:flex-shrink-0"
    :class="{'translate-x-0': sidebarOpen}"
    x-cloak
>

    <div class="h-16 flex items-center justify-between space-x-2 px-4 py-2 text-lg font-bold border-b border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/icon/logo.png') }}" alt="Logo" class="h-12 w-12 rounded-full">
            <div>
                <div class="font-bold text-xl text-purple-400">BALIKIN</div>
            </div>
        </a>

        <button @click="sidebarOpen = false" class="md:hidden p-1 text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white rounded-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-4">
        
        <ul class="space-y-1">
            <li>
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center space-x-2 px-4 py-2 rounded-md
                          {{ request()->routeIs('admin.dashboard') 
                             ? 'bg-purple-100 text-purple-700 dark:bg-gray-900 dark:text-white' 
                             : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 px-4 mt-6 block">Manajemen Konten</span>
        <ul class="space-y-1 mt-2">
            <li>
                <a href="{{ route('admin.validasi.lost-items.index') }}" 
                   class="flex items-center space-x-2 px-4 py-2 rounded-md
                          {{ request()->routeIs('admin.validasi.lost-items.*') 
                             ? 'bg-purple-100 text-purple-700 dark:bg-gray-900 dark:text-white' 
                             : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                    <span>Barang Hilang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.validasi.found-items.index') }}" 
                   class="flex items-center space-x-2 px-4 py-2 rounded-md
                          {{ request()->routeIs('admin.validasi.found-items.*') 
                             ? 'bg-purple-100 text-purple-700 dark:bg-gray-900 dark:text-white' 
                             : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                    <span>Barang Temuan</span>
                </a>
            </li>
        </ul>

        <span class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 px-4 mt-6 block">Manajemen Sistem</span>
        <ul class="space-y-1 mt-2">
            <li>
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center space-x-2 px-4 py-2 rounded-md
                          {{ request()->routeIs('admin.users.*') 
                             ? 'bg-purple-100 text-purple-700 dark:bg-gray-900 dark:text-white' 
                             : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                    <span>Manajemen User</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); this.closest('form').submit();"
               class="flex items-center space-x-2 px-4 py-2 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white">
                <span>Logout</span>
            </a>
        </form>
    </div>

</aside>