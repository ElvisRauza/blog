@php
    $routeName = Route::current()->getName();
@endphp

<nav class="bg-slate-100 dark:bg-slate-800">
    <ul>
        <li>
            <a class="block py-2 px-3 dark:text-slate-200 transition-colors hover:dark:bg-slate-800 {{ 'dashboard' == $routeName ? 'bg-slate-200 dark:bg-slate-700' : '' }}"
                href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li>
            <a class="block py-2 px-3 dark:text-slate-200 transition-colors hover:dark:bg-slate-800 {{ in_array($routeName, ['user.post.index', 'user.post.create', 'user.post.edit']) ? 'bg-slate-200 dark:bg-slate-700' : '' }}"
                href="{{ route('user.post.index') }}">{{ __('Manage blog posts') }}</a>
        </li>
        <li>
            <a class="block py-2 px-3 dark:text-slate-200 transition-colors hover:dark:bg-slate-800 {{ 'profile.edit' == $routeName ? 'bg-slate-200 dark:bg-slate-700' : '' }}"
                href="{{ route('profile.edit') }}">{{ __('Edit account') }}</a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="block text-left w-full py-2 px-3 dark:text-slate-200 transition-colors hover:dark:bg-slate-800">{{ __('Log out') }}</button>
            </form>
        </li>
    </ul>
</nav>
