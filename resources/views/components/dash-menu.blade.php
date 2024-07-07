@php
    $routeName = Route::current()->getName();
@endphp

<nav class="bg-slate-100">
    <ul>
        <li>
            <a class="block py-2 px-3 dark:text-slate-200 transition-colors hover:dark:bg-slate-800 {{ 'dashboard' == $routeName ? 'bg-slate-200 dark:bg-slate-700' : '' }}"
                href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li>
            <a class="block py-2 px-3 dark:text-slate-200 transition-colors hover:dark:bg-slate-800 {{ in_array($routeName, ['user.post.index', 'user.post.create']) ? 'bg-slate-200 dark:bg-slate-700' : '' }}"
                href="{{ route('user.post.index') }}">Manage blog posts</a>
        </li>
        <li>
            <a class="block py-2 px-3 dark:text-slate-200 transition-colors hover:dark:bg-slate-800 {{ 'profile.edit' == $routeName ? 'bg-slate-200 dark:bg-slate-700' : '' }}"
                href="{{ route('profile.edit') }}">Edit account</a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="block text-left w-full py-2 px-3 dark:text-slate-200 transition-colors hover:dark:bg-slate-800">Log
                    out</button>
            </form>
        </li>
    </ul>
</nav>
