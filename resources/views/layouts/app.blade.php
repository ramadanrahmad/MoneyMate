<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased overflow-hidden text-gray-900 bg-[#f8fafc]">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('layouts.navigation')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col w-0 overflow-hidden">
                <!-- Mobile Header Toggle -->
                <div class="md:hidden pt-4 px-4 flex items-center">
                    <button @click="sidebarOpen = true" class="p-2 rounded-md text-gray-500 bg-white shadow-sm border border-gray-100 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="ml-4 font-bold text-gray-800 text-lg">MoneyMate</div>
                </div>

                <!-- Page Content -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    @isset($header)
                        <div class="pt-6 md:pt-10 pb-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
                            {{ $header }}
                        </div>
                    @endisset
                    
                    <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full pb-12">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
