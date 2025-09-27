<section>
    <div class="max-w-xl mx-auto">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Informasi Profil') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Perbarui informasi profil dan data pribadi Anda.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <!-- Kolom Kiri: Foto Profil -->
                <div class="md:col-span-1">
                    <h3 class="text-md font-medium text-gray-900 dark:text-gray-100">Foto Profil</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Klik untuk memilih atau ganti foto Anda.</p>
                    <div class="mt-4">
                        @if (Auth::user()->profile_photo_path)
                            <img class="h-32 w-32 rounded-full object-cover" src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="Current profile photo">
                        @else
                            <div class="h-32 w-32 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-4xl">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <input id="photo" name="photo" type="file" class="mt-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                </div>

                <!-- Kolom Kanan: Isian Data -->
                <div class="md:col-span-3 space-y-6">
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    {{-- KOLOM-KOLOM BARU DIPINDAHKAN KE SINI --}}
                    <div>
                        <x-input-label for="nim" :value="__('NIM (Nomor Induk Mahasiswa)')" />
                        <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full" :value="old('nim', $user->nim)" />
                        <x-input-error class="mt-2" :messages="$errors->get('nim')" />
                    </div>
                    <div>
                        <x-input-label for="nip" :value="__('NIP (Nomor Induk Pegawai)')" />
                        <x-text-input id="nip" name="nip" type="text" class="mt-1 block w-full" :value="old('nip', $user->nip)" />
                        <x-input-error class="mt-2" :messages="$errors->get('nip')" />
                    </div>
                    <div>
                        <x-input-label for="jurusan" :value="__('Jurusan')" />
                        <x-text-input id="jurusan" name="jurusan" type="text" class="mt-1 block w-full" :value="old('jurusan', $user->jurusan)" />
                        <x-input-error class="mt-2" :messages="$errors->get('jurusan')" />
                    </div>
                    <div>
                        <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" />
                        <x-text-input id="nomor_telepon" name="nomor_telepon" type="tel" class="mt-1 block w-full" :value="old('nomor_telepon', $user->nomor_telepon)" />
                        <x-input-error class="mt-2" :messages="$errors->get('nomor_telepon')" />
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 mt-8">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>

