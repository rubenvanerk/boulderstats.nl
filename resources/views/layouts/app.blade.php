<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    @googlefonts

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script defer data-domain="boulderstats.nl" src="https://plausible.wrve.nl/js/plausible.js"></script>
</head>

<body class="font-sans antialiased h-full">
<div class="min-h-full bg-gray-100">

    <x-nav/>

    <div>

        @hasSection('header')
            <header>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold leading-tight text-gray-900">@yield('header')</h1>
                </div>
            </header>
        @endif

        <main>
            <div class="max-w-7xl mx-auto p-4">
                {{ $slot }}
            </div>
        </main>

    </div>
</div>

<x-footer/>

@livewireScripts
</body>
</html>

