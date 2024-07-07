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
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="flex-1">
            @isset($sidebar)
                <div class="container md:grid md:grid-cols-4 md:gap-14">
                    <div class="pt-8">
                        {{ $sidebar }}
                    </div>
                    <div class="pt-8 md:col-span-3">
                        {{ $slot }}
                    </div>
                </div>
            @else
                {{ $slot }}
            @endisset
        </main>

        <footer class="container py-2">
            <p class="text-slate-300 dark:text-slate-700 text-center">&copy; All rights reserved {{ gmdate('Y') }}</p>
        </footer>
    </div>
</body>

</html>
