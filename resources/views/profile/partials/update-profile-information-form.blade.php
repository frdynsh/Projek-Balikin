<section class="text-gray-100 border border-gray-700 rounded-lg shadow-sm p-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <!-- Kiri: Header dan Avatar -->
        <div>
            <h2 class="text-lg font-semibold text-white">Personal Information</h2>
            <p class="mt-2 text-sm text-gray-400">
                Update your account’s profile information and email address.
            </p>
        </div>

        <!-- Kanan: Form -->
        <div class="md:col-span-2 space-y-6">
            <div class="mt-6 flex items-center space-x-4">
                @if (Auth::user()->profile_photo_path)
                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" 
                        alt="Avatar" class="w-20 h-20 rounded-full object-cover border border-gray-700">
                @else
                    <div class="w-20 h-20 rounded-full bg-purple-600 flex items-center justify-center text-2xl font-bold border border-gray-700">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif

                <div>
                    <label class="block">
                        <span class="sr-only">Choose avatar</span>
                        <input type="file" name="photo" id="photo"
                            class="block text-sm text-gray-400 file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-500 cursor-pointer" />
                    </label>
                    <p class="text-xs text-gray-500 mt-1">JPG, GIF, or PNG. 1MB max.</p>
                    <x-input-error class="mt-1" :messages="$errors->get('photo')" />
                </div>
            </div>
            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="name" :value="__('Full name')" />
                        <x-text-input id="name" name="name" type="text"
                            class="mt-1 block w-full bg-gray-800 border border-gray-700 text-gray-100 rounded-md focus:ring-purple-500 focus:border-purple-500"
                            :value="old('name', $user->name)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email address')" />
                        <x-text-input id="email" name="email" type="email"
                            class="mt-1 block w-full bg-gray-800 border border-gray-700 text-gray-100 rounded-md focus:ring-purple-500 focus:border-purple-500"
                            :value="old('email', $user->email)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="nim" :value="__('NIM')" />
                        <x-text-input id="nim" name="nim" type="text"
                            class="mt-1 block w-full bg-gray-800 border border-gray-700 text-gray-100 rounded-md focus:ring-purple-500 focus:border-purple-500"
                            :value="old('nim', $user->nim)" />
                    </div>

                    <div>
                        <x-input-label for="nip" :value="__('NIP')" />
                        <x-text-input id="nip" name="nip" type="text"
                            class="mt-1 block w-full bg-gray-800 border border-gray-700 text-gray-100 rounded-md focus:ring-purple-500 focus:border-purple-500"
                            :value="old('nip', $user->nip)" />
                    </div>
                </div>

                <div>
                    <x-input-label for="jurusan" :value="__('Jurusan')" />
                    <x-text-input id="jurusan" name="jurusan" type="text"
                        class="mt-1 block w-full bg-gray-800 border border-gray-700 text-gray-100 rounded-md focus:ring-purple-500 focus:border-purple-500"
                        :value="old('jurusan', $user->jurusan)" />
                </div>

                <div>
                    <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" />
                    <x-text-input id="nomor_telepon" name="nomor_telepon" type="tel"
                        class="mt-1 block w-full bg-gray-800 border border-gray-700 text-gray-100 rounded-md focus:ring-purple-500 focus:border-purple-500"
                        :value="old('nomor_telepon', $user->nomor_telepon)" />
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <x-primary-button class="bg-purple-600 hover:bg-purple-500 text-white border border-gray-700">
                        {{ __('Save Changes') }}
                    </x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition 
                           x-init="setTimeout(() => show = false, 2000)"
                           class="text-sm text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
