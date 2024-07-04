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

<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="flex-1">
            @isset($sidebar)
                <div class="container grid grid-cols-4 mt-8">
                    <div>
                        {{ $sidebar }}
                    </div>
                    <div class="col-span-3">
                        {{ $slot }}
                    </div>
                </div>
            @else
                {{ $slot }}
                @endif
            </main>

            <footer class="container py-2">
                <p class="text-slate-300 dark:text-slate-700 text-center">&copy; All rights reserved {{ gmdate('Y') }}</p>
            </footer>
        </div>
    </body>

    </html>
