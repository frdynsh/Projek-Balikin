<aside class="w-64 h-full bg-white dark:bg-gray-800 text-gray-800 dark:text-white flex flex-col border-r border-gray-200 dark:border-gray-700">

    <div class="h-16 flex items-center space-x-2 px-4 py-2 text-lg font-bold border-b border-gray-200 dark:border-gray-700">
        <img src="{{ asset('images/icon/logo.png') }}" alt="Logo" class="h-12 w-12 rounded-full">
        <div class="hidden md:block">
            <div class="font-bold text-xl text-purple-400">BALIKIN</div>
        </div>
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
                          {{ request()->routeIs('admin.validasi.lost-items.index') 
                             ? 'bg-purple-100 text-purple-700 dark:bg-gray-900 dark:text-white' 
                             : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                    <span>Barang Hilang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.validasi.found-items.index') }}" 
                   class="flex items-center space-x-2 px-4 py-2 rounded-md
                          {{ request()->routeIs('admin.validasi.found-items.index') 
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
                          {{ request()->routeIs('admin.users.index') 
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