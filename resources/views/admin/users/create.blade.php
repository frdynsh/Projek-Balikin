<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Tambah User Baru') }}
                </h2>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                    Kembali
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="nim" :value="__('NIM (opsional, untuk mahasiswa)')" />
                            <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim')" autocomplete="off" />
                            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                        </div>
                        
                        <div class="mt-4">
                            <x-input-label for="nip" :value="__('NIP (opsional, untuk dosen/staf)')" />
                            <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip" :value="old('nip')" autocomplete="off" />
                            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="jurusan" :value="__('Jurusan (opsional)')" />
                            <x-text-input id="jurusan" class="block mt-1 w-full" type="text" name="jurusan" :value="old('jurusan')" autocomplete="off" />
                            <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="nomor_telepon" :value="__('Nomor Telepon (opsional)')" />
                            <x-text-input id="nomor_telepon" class="block mt-1 w-full" type="text" name="nomor_telepon" :value="old('nomor_telepon')" autocomplete="off" />
                            <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="role" :value="__('Role')" />
                            <select name="role" id="role" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Create User') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>