<section class="text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-700 
                rounded-lg shadow-sm p-8 bg-white dark:bg-gray-800">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <!-- Kiri: Header dan Avatar -->
        <div>
            <h2 class="text-lg font-semibold text-white">Update Password</h2>
            <p class="mt-2 text-sm text-gray-400">
                Ensure your account is using a long, random password to stay secure.
            </p>
        </div>

        <!-- Kanan: Form -->
        <div class="md:col-span-2 space-y-6">
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                    <x-text-input
                        id="update_password_current_password"
                        name="current_password"
                        type="password"
                        class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500"
                        autocomplete="current-password"
                    />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="update_password_password" :value="__('New Password')" />
                    <x-text-input
                        id="update_password_password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500"
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input
                        id="update_password_password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500"
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <x-primary-button class="px-5 py-2.5 text-sm font-semibold">
                        {{ __('Save Changes') }}
                    </x-primary-button>

                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-green-600 dark:text-green-400 font-medium"
                        >
                            {{ __('Saved.') }}
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
