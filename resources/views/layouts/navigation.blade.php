<header class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="container">
        <div class="flex justify-between items-center py-4">
            <a href="/" aria-label="Homepage">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>

            <nav class="flex gap-4">
                <a class="text-gray-800 dark:text-gray-200" href="{{ route('blog.index') }}">Blog</a>

                @auth
                    <a class="text-gray-800 dark:text-gray-200" href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="text-gray-800 dark:text-gray-200" href="{{ route('login') }}">Log in</a>
                @endauth
            </nav>
        </div>
    </div>
</header>
