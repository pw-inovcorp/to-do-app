<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-montserrat">
    <div class="min-h-screen bg-gray-50 flex">

        <button id="mobile-menu-btn" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-white rounded-md shadow-lg">
            <svg class="w-6 h-6 text-gray-600 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <div id="sidebar-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>


        <div id="sidebar" class="fixed lg:sticky lg:top-0 w-56 bg-white  shadow-lg h-full lg:min-h-screen transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40">
            @include('layouts.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="pl-12 lg:pl-0">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @if(session()->has('success'))
                    <div class="mx-3 sm:mx-4 lg:mx-8 mt-4 p-4 border-l-4 bg-green-50 border-green-400 text-green-700">
                        {{session('success')}}
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleMobileMenu() {
            const isHidden = sidebar.classList.contains('-translate-x-full');

            if (isHidden) {

                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {

                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        mobileMenuBtn?.addEventListener('click', toggleMobileMenu);
        overlay?.addEventListener('click', function() {

            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
