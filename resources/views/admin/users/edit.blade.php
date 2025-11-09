<x-admin-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Edit User') }}: {{ $user->name }}
                </h2>
                <a href="{{ route('admin.users.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Kembali
                </a>
            </div>

            @if (session('warning'))
                <div class="p-4 rounded-lg border border-yellow-400 bg-yellow-50 dark:bg-yellow-900/40 dark:border-yellow-700 text-yellow-800 dark:text-yellow-200 shadow-sm">
                    {{ session('warning') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Nama -->
                        <div>
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" class="block mt-1 w-full bg-gray-100 dark:bg-gray-900/40" 
                                type="text" name="name" :value="old('name', $user->name)" required readonly />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full bg-gray-100 dark:bg-gray-900/40" 
                                type="email" name="email" :value="old('email', $user->email)" required readonly />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- NIM -->
                        <div class="mt-4">
                            <x-input-label for="nim" :value="__('NIM (opsional)')" />
                            <x-text-input id="nim" class="block mt-1 w-full bg-gray-100 dark:bg-gray-900/40" 
                                type="text" name="nim" :value="old('nim', $user->nim)" readonly />
                            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                        </div>

                        <!-- NIP -->
                        <div class="mt-4">
                            <x-input-label for="nip" :value="__('NIP (opsional)')" />
                            <x-text-input id="nip" class="block mt-1 w-full bg-gray-100 dark:bg-gray-900/40" 
                                type="text" name="nip" :value="old('nip', $user->nip)" readonly />
                            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                        </div>

                        <!-- Jurusan -->
                        <div class="mt-4">
                            <x-input-label for="jurusan" :value="__('Jurusan (opsional)')" />
                            <x-text-input id="jurusan" class="block mt-1 w-full bg-gray-100 dark:bg-gray-900/40" 
                                type="text" name="jurusan" :value="old('jurusan', $user->jurusan)" readonly />
                            <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="mt-4">
                            <x-input-label for="nomor_telepon" :value="__('Nomor Telepon (opsional)')" />
                            <x-text-input id="nomor_telepon" class="block mt-1 w-full bg-gray-100 dark:bg-gray-900/40" 
                                type="text" name="nomor_telepon" :value="old('nomor_telepon', $user->nomor_telepon)" readonly />
                            <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2" />
                        </div>

                        <hr class="my-6 border-gray-300 dark:border-gray-700">

                        <!-- Role -->
                        <div class="mt-4">
                            <x-input-label for="role" :value="__('Role')" />
                            <select name="role" id="role" 
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm">
                                <option value="user" @selected(old('role', $user->role) == 'user')>User</option>
                                <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Update User') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
