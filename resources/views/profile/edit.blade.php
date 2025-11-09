@php
    $layout = Auth::user()->role === 'admin' ? 'admin-layout' : 'app-layout';
@endphp

<x-dynamic-component :component="$layout">
    <div class="@if(Auth::user()->role === 'admin') py-4 @else py-32 @endif min-h-screen text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ tab: 'profile' }">
            
            {{-- Header Tab Navigation --}}
            <div class="border-b border-gray-700 mb-8">
                <nav class="flex space-x-8" aria-label="Tabs">
                    <button @click="tab = 'profile'"
                        :class="tab === 'profile' ? 'text-indigo-400 border-indigo-400' : 'text-gray-400 hover:text-gray-200 hover:border-gray-500'"
                        class="px-1 pb-4 text-sm font-medium border-b-2">
                        Profile
                    </button>
                    <button @click="tab = 'password'"
                        :class="tab === 'password' ? 'text-indigo-400 border-indigo-400' : 'text-gray-400 hover:text-gray-200 hover:border-gray-500'"
                        class="px-1 pb-4 text-sm font-medium border-b-2">
                        Update Password
                    </button>
                    <button @click="tab = 'delete'"
                        :class="tab === 'delete' ? 'text-indigo-400 border-indigo-400' : 'text-gray-400 hover:text-gray-200 hover:border-gray-500'"
                        class="px-1 pb-4 text-sm font-medium border-b-2">
                        Delete Account
                    </button>
                </nav>
            </div>

            {{-- Profile Section --}}
            <div x-show="tab === 'profile'" x-transition>
                <div class="bg-gray-800 shadow sm:rounded-lg p-6 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password Section --}}
            <div x-show="tab === 'password'" x-transition>
                <div class="bg-gray-800 shadow sm:rounded-lg p-6 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account Section --}}
            <div x-show="tab === 'delete'" x-transition>
                <div class="bg-gray-800 shadow sm:rounded-lg p-6 sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
