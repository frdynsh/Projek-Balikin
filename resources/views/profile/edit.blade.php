@php
    $layout = Auth::user()->role === 'admin' ? 'admin-layout' : 'app-layout';
@endphp

<x-dynamic-component :component="$layout">
    <div class="@if(Auth::user()->role === 'admin') py-4 @else py-32 @endif min-h-screen text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ tab: 'profile' }">
            
            {{-- Header Tab Navigation --}}
            <div class="border-b border-gray-700 mb-8 px-4 sm:px-6 lg:px-0">
                <nav class="flex space-x-8 overflow-x-auto" aria-label="Tabs">
                    <button @click="tab = 'profile'"
                        :class="tab === 'profile' 
                                ? 'text-indigo-400 border-indigo-400 border-b-2' 
                                : 'text-gray-400 hover:text-gray-200 hover:border-gray-500 border-b-0'"
                        class="px-1 pb-4 text-sm font-medium whitespace-nowrap">
                        Profile
                    </button>
                    <button @click="tab = 'password'"
                        :class="tab === 'password' 
                                ? 'text-indigo-400 border-indigo-400 border-b-2' 
                                : 'text-gray-400 hover:text-gray-200 hover:border-gray-500 border-b-0'"
                        class="px-1 pb-4 text-sm font-medium whitespace-nowrap">
                        Update Password
                    </button>
                    <button @click="tab = 'delete'"
                        :class="tab === 'delete' 
                                ? 'text-indigo-400 border-indigo-400 border-b-2' 
                                : 'text-gray-400 hover:text-gray-200 hover:border-gray-500 border-b-0'"
                        class="px-1 pb-4 text-sm font-medium whitespace-nowrap">
                        Delete Account
                    </button>
                </nav>
            </div>

            {{-- Profile Section --}}
            <div x-show="tab === 'profile'" x-transition>
                <div class="px-4 sm:px-6 lg:px-0">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password Section --}}
            <div x-show="tab === 'password'" x-transition>
                <div class="px-4 sm:px-6 lg:px-0">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account Section --}}
            <div x-show="tab === 'delete'" x-transition>
                <div class="px-4 sm:px-6 lg:px-0">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
