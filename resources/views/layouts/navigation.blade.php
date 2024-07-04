<header class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="container">
        <div class="flex items-center justify-between py-4">
            <a href="/">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>

            @auth
                <a class="text-gray-800 dark:text-gray-200" href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a class="text-gray-800 dark:text-gray-200" href="{{ route('login') }}">Log in</a>
            @endauth
        </div>
    </div>
</header>
