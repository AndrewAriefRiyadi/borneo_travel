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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="fixed top-5 right-5 z-50">
            <div class="flex items-center gap-3 rounded-lg bg-green-600 px-4 py-3 text-white shadow-lg">
                <span class="text-sm font-medium">{{ session('success') }}</span>

                <button type="button" @click="show = false" class="text-white/80 hover:text-white font-bold">
                    ✕
                </button>
            </div>
        </div>
    @endif


    @if (session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3500)" x-show="show" x-transition
            class="fixed top-5 right-5 z-50">
            <div class="flex items-center gap-3 rounded-lg bg-red-600 px-4 py-3 text-white shadow-lg">
                <span class="text-sm font-medium">{{ session('error') }}</span>

                <button type="button" @click="show = false" class="text-white/80 hover:text-white font-bold">
                    ✕
                </button>
            </div>
        </div>
    @endif


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    @stack('scripts')

</body>

</html>
