<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gold Prediction') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-gray-100">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-4 text-center text-xl font-bold text-gray-700">
                Gold Prediction
            </div>
            <nav class="mt-6">
                <ul>
                    <li class="py-2 px-4 hover:bg-gray-200">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                            <span>📊</span> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="py-2 px-4 hover:bg-gray-200">
                        <a href="{{ route('data-historis') }}" class="flex items-center space-x-2">
                            <span>📅</span> <span>Data Historis</span>
                        </a>
                    </li>
                    <li class="py-2 px-4 hover:bg-gray-200">
                        <a href="{{ route('prediksi-harga') }}" class="flex items-center space-x-2">
                            <span>📈</span> <span>Prediksi Harga</span>
                        </a>
                    </li>
                    <li class="py-2 px-4 hover:bg-gray-200">
                        <a href="{{ route('indikator-teknikal') }}" class="flex items-center space-x-2">
                            <span>📉</span> <span>Indikator Teknikal</span>
                        </a>
                    </li>
                    <li class="py-2 px-4 hover:bg-gray-200">
                        <a href="{{ route('analisis-ekonomi') }}" class="flex items-center space-x-2">
                            <span>💰</span> <span>Analisis Ekonomi</span>
                        </a>
                    </li>
                    <li class="py-2 px-4 hover:bg-gray-200">
                        <a href="{{ route('manajemen-data') }}" class="flex items-center space-x-2">
                            <span>📂</span> <span>Manajemen Data</span>
                        </a>
                    </li>
                    <li class="py-2 px-4 hover:bg-gray-200">
                        <a href="{{ route('pengaturan-model') }}" class="flex items-center space-x-2">
                            <span>⚙️</span> <span>Pengaturan Model AI</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        <div>
                            {{ $header }}
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center ml-auto">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a 1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </header>
            @endisset


            <!-- Page Content -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
