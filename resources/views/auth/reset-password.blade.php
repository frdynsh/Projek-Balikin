<x-guest-layout>
    <div class="w-full sm:max-w-md">
        <!-- Logo, Judul, dan Subjudul -->
        <div class="text-center">
            <a href="/" class="inline-block">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <h2 class="mt-6 text-2xl font-bold text-gray-800 dark:text-gray-200">
                Atur Ulang Password Anda
            </h2>
        </div>

        <div class="mt-8">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Token Reset Password -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Alamat Email -->
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password Baru -->
                <div class="mt-4" x-data="{ showPassword: false }">
                    <x-input-label for="password" value="Password Baru" />
                    <div class="relative">
                        <x-text-input id="password" class="block mt-1 w-full pr-10" x-bind:type="showPassword ? 'text' : 'password'" name="password" required autocomplete="new-password" />
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400">
                            <svg x-show="!showPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                            <svg x-show="showPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="display: none;"><path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" /><path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.18l.88-1.465A10.004 10.004 0 0110 3c2.451 0 4.786.993 6.457 2.645l.88 1.465a1.651 1.651 0 010 1.18l-.88 1.465A10.004 10.004 0 0110 17c-2.451 0-4.786-.993-6.457-2.645l-.88-1.465zM10 15a5 5 0 100-10 5 5 0 000 10z" clip-rule="evenodd" /><path d="M16.707 3.293a1 1 0 010 1.414L3.293 16.707a1 1 0 01-1.414-1.414L16.707 3.293z" /></svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Konfirmasi Password Baru -->
                <div class="mt-4" x-data="{ showPassword: false }">
                    <x-input-label for="password_confirmation" value="Konfirmasi Password Baru" />
                    <div class="relative">
                        <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10" x-bind:type="showPassword ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" />
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400">
                            <svg x-show="!showPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                            <svg x-show="showPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="display: none;"><path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" /><path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.18l.88-1.465A10.004 10.004 0 0110 3c2.451 0 4.786.993 6.457 2.645l.88 1.465a1.651 1.651 0 010 1.18l-.88 1.465A10.004 10.004 0 0110 17c-2.451 0-4.786-.993-6.457-2.645l-.88-1.465zM10 15a5 5 0 100-10 5 5 0 000 10z" clip-rule="evenodd" /><path d="M16.707 3.293a1 1 0 010 1.414L3.293 16.707a1 1 0 01-1.414-1.414L16.707 3.293z" /></svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Tombol Reset -->
                <div class="mt-6">
                    <x-primary-button class="w-full justify-center bg-purple-500 hover:bg-purple-800 focus:bg-purple-800 active:bg-purple-900 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:bg-purple-700 dark:active:bg-purple-800">
                        Reset Password
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

