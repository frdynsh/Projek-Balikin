<x-admin-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- HEADER -->
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Manajemen User') }}
                </h2>
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-500 active:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Tambah User
                </a>
            </div>

            <!-- TABEL KONTEN UTAMA -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $user->role }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center space-x-4">
                                            
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-600">Edit</a>
                                            
                                            <!-- Tombol Hapus -->
                                            <form id="delete-user-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button 
                                                data-action="hapus"
                                                data-name="{{ $user->name }}"
                                                data-form="delete-user-{{ $user->id }}"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 text-sm font-semibold">
                                                Hapus
                                            </button>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada data user lain.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
