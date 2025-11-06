<x-app-layout>
    {{-- ====== HERO SECTION ====== --}}
    <div class="relative min-h-screen overflow-hidden bg-white dark:bg-[#111828] text-gray-900 dark:text-white transition-colors duration-500 isolate px-6 lg:px-8">

        {{-- === GRADIENT BACKGROUND (tidak full layar) === --}}
        <div 
            class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" 
            aria-hidden="true">
            <div 
                class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] 
                       -translate-x-1/6 rotate-[30deg] 
                       bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] dark:from-[#4f46e5] dark:to-[#9333ea] opacity-30 
                       sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" 
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 
                       85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 
                       60.2% 62.4%, 52.4% 68.1%, 
                       47.5% 58.3%, 45.2% 34.5%, 
                       27.5% 76.7%, 0.1% 64.9%, 
                       17.9% 100%, 27.6% 76.8%, 
                       76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>

        <div class="relative z-10 mx-auto px-6 py-20 lg:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <div class="space-y-8">
                    <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight">
                        Kita bantu kamu <br>menemukan <span class="text-purple-600 dark:text-purple-400">barang yang hilang</span>.
                    </h1>

                    <p class="text-lg text-gray-700 dark:text-gray-300 max-w-xl">
                        Layanan <span class="text-purple-600 dark:text-purple-400 font-semibold">Balikin</span> memudahkan kamu mencari atau mengembalikan barang yang hilang di lingkungan kampus dengan cepat dan aman.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('lost-items.create') }}" 
                           class="bg-purple-600 hover:bg-purple-500 text-white px-6 py-3 rounded-lg font-medium transition">
                            Lapor Kehilangan
                        </a>

                        <a href="{{ route('found-items.create') }}" 
                           class="border border-purple-600 hover:bg-purple-100 dark:hover:bg-purple-500/10 text-purple-600 dark:text-purple-400 px-6 py-3 rounded-lg font-medium transition">
                            Laporkan Penemuan
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col gap-6">
                        <img src="{{ asset('images/hero-section/1.jpg') }}" class="rounded-2xl shadow-lg object-cover h-48 w-full hover:scale-105 transition-transform duration-500">
                        <img src="{{ asset('images/hero-section/2.webp') }}" class="rounded-2xl shadow-lg object-cover h-72 w-full hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="flex flex-col gap-6 mt-12">
                        <img src="{{ asset('images/hero-section/3.jpg') }}" class="rounded-2xl shadow-lg object-cover h-72 w-full hover:scale-105 transition-transform duration-500">
                        <img src="{{ asset('images/hero-section/4.jpg') }}" class="rounded-2xl shadow-lg object-cover h-48 w-full hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ====== OUR TEAM SECTION ====== --}}
    <section class="py-24 bg-gray-50 dark:bg-[#111827] transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-4 text-gray-900 dark:text-white">Meet our team</h2>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-16">
                Kami adalah tim yang bersemangat dalam membangun <span class="text-purple-600 dark:text-purple-400 font-semibold">Balikin</span> 
                <br>agar pengalaman kehilangan & menemukan barang di kampus jadi lebih mudah dan efisien.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                {{-- Anggota 1 --}}
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg">
                    <img src="{{ asset('images/hero-section/1.jpg') }}" alt="Tim 1" class="w-32 h-32 mx-auto rounded-full object-cover mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ariella Chandra Naya</h3>
                    <div class="flex justify-center gap-4 mt-4">
                        {{-- GitHub --}}
                        <a href="https://github.com/ariellachh" class="text-gray-500 hover:text-purple-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 .5C5.73.5.5 5.74.5 12.02c0 5.1 3.29 9.43 7.86 10.96.58.1.8-.25.8-.56v-2c-3.2.7-3.87-1.38-3.87-1.38-.53-1.35-1.3-1.7-1.3-1.7-1.06-.72.08-.7.08-.7 1.17.09 1.78 1.2 1.78 1.2 1.04 1.78 2.73 1.26 3.4.97.1-.76.4-1.26.73-1.55-2.55-.3-5.23-1.28-5.23-5.7 0-1.26.45-2.28 1.2-3.08-.12-.3-.52-1.52.1-3.18 0 0 .98-.32 3.2 1.18a10.9 10.9 0 0 1 5.83 0c2.22-1.5 3.2-1.18 3.2-1.18.62 1.66.22 2.88.1 3.18.75.8 1.2 1.82 1.2 3.08 0 4.43-2.68 5.4-5.23 5.7.4.34.76 1 .76 2.02v3c0 .3.22.66.8.55A10.52 10.52 0 0 0 23.5 12C23.5 5.74 18.27.5 12 .5Z" clip-rule="evenodd" />
                            </svg>
                        </a>

                        {{-- Instagram --}}
                        <a href="https://www.instagram.com/ariellachh/" class="text-gray-500 hover:text-purple-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                                <path d="M12 2.2c3.18 0 3.56 0 4.82.07 1.17.07 1.8.25 2.22.42.56.22.96.48 1.38.9.42.42.68.82.9 1.38.17.42.35 1.05.42 2.22.07 1.26.07 1.64.07 4.82s0 3.56-.07 4.82c-.07 1.17-.25 1.8-.42 2.22a3.5 3.5 0 0 1-.9 1.38 3.5 3.5 0 0 1-1.38.9c-.42.17-1.05.35-2.22.42-1.26.07-1.64.07-4.82.07s-3.56 0-4.82-.07c-1.17-.07-1.8-.25-2.22-.42a3.5 3.5 0 0 1-1.38-.9 3.5 3.5 0 0 1-.9-1.38c-.17-.42-.35-1.05-.42-2.22C2.2 15.56 2.2 15.18 2.2 12s0-3.56.07-4.82c.07-1.17.25-1.8.42-2.22.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.17 1.05-.35 2.22-.42C8.44 2.2 8.82 2.2 12 2.2Zm0-2.2C8.78 0 8.36 0 7.09.07 5.8.13 4.8.33 4 .65a5.67 5.67 0 0 0-2.1 1.37A5.67 5.67 0 0 0 .65 4c-.32.8-.52 1.8-.58 3.09C0 8.36 0 8.78 0 12s0 3.64.07 4.91c.06 1.29.26 2.29.58 3.09.33.8.77 1.5 1.37 2.1a5.67 5.67 0 0 0 2.1 1.37c.8.32 1.8.52 3.09.58C8.36 24 8.78 24 12 24s3.64 0 4.91-.07c1.29-.06 2.29-.26 3.09-.58a5.67 5.67 0 0 0 2.1-1.37 5.67 5.67 0 0 0 1.37-2.1c.32-.8.52-1.8.58-3.09.07-1.27.07-1.69.07-4.91s0-3.64-.07-4.91c-.06-1.29-.26-2.29-.58-3.09a5.67 5.67 0 0 0-1.37-2.1A5.67 5.67 0 0 0 20 .65c-.8-.32-1.8-.52-3.09-.58C15.64 0 15.22 0 12 0Z"/>
                                <path d="M12 5.84a6.16 6.16 0 1 0 0 12.32 6.16 6.16 0 0 0 0-12.32Zm0 10.16a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm6.4-11.82a1.44 1.44 0 1 1-2.88 0 1.44 1.44 0 0 1 2.88 0Z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Anggota 2 --}}
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg">
                    <img src="{{ asset('images/hero-section/1.jpg') }}" alt="Tim 2" class="w-32 h-32 mx-auto rounded-full object-cover mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ferdi Yansah</h3>
                    <div class="flex justify-center gap-4 mt-4">
                        {{-- GitHub --}}
                        <a href="https://github.com/frdynsh/" class="text-gray-500 hover:text-purple-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 .5C5.73.5.5 5.74.5 12.02c0 5.1 3.29 9.43 7.86 10.96.58.1.8-.25.8-.56v-2c-3.2.7-3.87-1.38-3.87-1.38-.53-1.35-1.3-1.7-1.3-1.7-1.06-.72.08-.7.08-.7 1.17.09 1.78 1.2 1.78 1.2 1.04 1.78 2.73 1.26 3.4.97.1-.76.4-1.26.73-1.55-2.55-.3-5.23-1.28-5.23-5.7 0-1.26.45-2.28 1.2-3.08-.12-.3-.52-1.52.1-3.18 0 0 .98-.32 3.2 1.18a10.9 10.9 0 0 1 5.83 0c2.22-1.5 3.2-1.18 3.2-1.18.62 1.66.22 2.88.1 3.18.75.8 1.2 1.82 1.2 3.08 0 4.43-2.68 5.4-5.23 5.7.4.34.76 1 .76 2.02v3c0 .3.22.66.8.55A10.52 10.52 0 0 0 23.5 12C23.5 5.74 18.27.5 12 .5Z" clip-rule="evenodd" />
                            </svg>
                        </a>

                        {{-- Instagram --}}
                        <a href="https://www.instagram.com/frdynsha_/" class="text-gray-500 hover:text-purple-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                                <path d="M12 2.2c3.18 0 3.56 0 4.82.07 1.17.07 1.8.25 2.22.42.56.22.96.48 1.38.9.42.42.68.82.9 1.38.17.42.35 1.05.42 2.22.07 1.26.07 1.64.07 4.82s0 3.56-.07 4.82c-.07 1.17-.25 1.8-.42 2.22a3.5 3.5 0 0 1-.9 1.38 3.5 3.5 0 0 1-1.38.9c-.42.17-1.05.35-2.22.42-1.26.07-1.64.07-4.82.07s-3.56 0-4.82-.07c-1.17-.07-1.8-.25-2.22-.42a3.5 3.5 0 0 1-1.38-.9 3.5 3.5 0 0 1-.9-1.38c-.17-.42-.35-1.05-.42-2.22C2.2 15.56 2.2 15.18 2.2 12s0-3.56.07-4.82c.07-1.17.25-1.8.42-2.22.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.17 1.05-.35 2.22-.42C8.44 2.2 8.82 2.2 12 2.2Zm0-2.2C8.78 0 8.36 0 7.09.07 5.8.13 4.8.33 4 .65a5.67 5.67 0 0 0-2.1 1.37A5.67 5.67 0 0 0 .65 4c-.32.8-.52 1.8-.58 3.09C0 8.36 0 8.78 0 12s0 3.64.07 4.91c.06 1.29.26 2.29.58 3.09.33.8.77 1.5 1.37 2.1a5.67 5.67 0 0 0 2.1 1.37c.8.32 1.8.52 3.09.58C8.36 24 8.78 24 12 24s3.64 0 4.91-.07c1.29-.06 2.29-.26 3.09-.58a5.67 5.67 0 0 0 2.1-1.37 5.67 5.67 0 0 0 1.37-2.1c.32-.8.52-1.8.58-3.09.07-1.27.07-1.69.07-4.91s0-3.64-.07-4.91c-.06-1.29-.26-2.29-.58-3.09a5.67 5.67 0 0 0-1.37-2.1A5.67 5.67 0 0 0 20 .65c-.8-.32-1.8-.52-3.09-.58C15.64 0 15.22 0 12 0Z"/>
                                <path d="M12 5.84a6.16 6.16 0 1 0 0 12.32 6.16 6.16 0 0 0 0-12.32Zm0 10.16a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm6.4-11.82a1.44 1.44 0 1 1-2.88 0 1.44 1.44 0 0 1 2.88 0Z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Anggota 3 --}}
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg">
                    <img src="{{ asset('images/hero-section/1.jpg') }}" alt="Tim 3" class="w-32 h-32 mx-auto rounded-full object-cover mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Erika Sita Dewi</h3>
                    <div class="flex justify-center gap-4 mt-4">
                        {{-- GitHub --}}
                        <a href="https://github.com/erikasd1" class="text-gray-500 hover:text-purple-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 .5C5.73.5.5 5.74.5 12.02c0 5.1 3.29 9.43 7.86 10.96.58.1.8-.25.8-.56v-2c-3.2.7-3.87-1.38-3.87-1.38-.53-1.35-1.3-1.7-1.3-1.7-1.06-.72.08-.7.08-.7 1.17.09 1.78 1.2 1.78 1.2 1.04 1.78 2.73 1.26 3.4.97.1-.76.4-1.26.73-1.55-2.55-.3-5.23-1.28-5.23-5.7 0-1.26.45-2.28 1.2-3.08-.12-.3-.52-1.52.1-3.18 0 0 .98-.32 3.2 1.18a10.9 10.9 0 0 1 5.83 0c2.22-1.5 3.2-1.18 3.2-1.18.62 1.66.22 2.88.1 3.18.75.8 1.2 1.82 1.2 3.08 0 4.43-2.68 5.4-5.23 5.7.4.34.76 1 .76 2.02v3c0 .3.22.66.8.55A10.52 10.52 0 0 0 23.5 12C23.5 5.74 18.27.5 12 .5Z" clip-rule="evenodd" />
                            </svg>
                        </a>

                        {{-- Instagram --}}
                        <a href="https://www.instagram.com/erikastdw/" class="text-gray-500 hover:text-purple-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                                <path d="M12 2.2c3.18 0 3.56 0 4.82.07 1.17.07 1.8.25 2.22.42.56.22.96.48 1.38.9.42.42.68.82.9 1.38.17.42.35 1.05.42 2.22.07 1.26.07 1.64.07 4.82s0 3.56-.07 4.82c-.07 1.17-.25 1.8-.42 2.22a3.5 3.5 0 0 1-.9 1.38 3.5 3.5 0 0 1-1.38.9c-.42.17-1.05.35-2.22.42-1.26.07-1.64.07-4.82.07s-3.56 0-4.82-.07c-1.17-.07-1.8-.25-2.22-.42a3.5 3.5 0 0 1-1.38-.9 3.5 3.5 0 0 1-.9-1.38c-.17-.42-.35-1.05-.42-2.22C2.2 15.56 2.2 15.18 2.2 12s0-3.56.07-4.82c.07-1.17.25-1.8.42-2.22.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.17 1.05-.35 2.22-.42C8.44 2.2 8.82 2.2 12 2.2Zm0-2.2C8.78 0 8.36 0 7.09.07 5.8.13 4.8.33 4 .65a5.67 5.67 0 0 0-2.1 1.37A5.67 5.67 0 0 0 .65 4c-.32.8-.52 1.8-.58 3.09C0 8.36 0 8.78 0 12s0 3.64.07 4.91c.06 1.29.26 2.29.58 3.09.33.8.77 1.5 1.37 2.1a5.67 5.67 0 0 0 2.1 1.37c.8.32 1.8.52 3.09.58C8.36 24 8.78 24 12 24s3.64 0 4.91-.07c1.29-.06 2.29-.26 3.09-.58a5.67 5.67 0 0 0 2.1-1.37 5.67 5.67 0 0 0 1.37-2.1c.32-.8.52-1.8.58-3.09.07-1.27.07-1.69.07-4.91s0-3.64-.07-4.91c-.06-1.29-.26-2.29-.58-3.09a5.67 5.67 0 0 0-1.37-2.1A5.67 5.67 0 0 0 20 .65c-.8-.32-1.8-.52-3.09-.58C15.64 0 15.22 0 12 0Z"/>
                                <path d="M12 5.84a6.16 6.16 0 1 0 0 12.32 6.16 6.16 0 0 0 0-12.32Zm0 10.16a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm6.4-11.82a1.44 1.44 0 1 1-2.88 0 1.44 1.44 0 0 1 2.88 0Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
