<nav class="">
    <ul class="flex flex-col gap-3">
        <li>
            <a class="block py-2 px-3 dark:text-slate-200 transition-colors  hover:dark:bg-slate-800"
                href="{{ route('user.post.index') }}">Manage blog posts</a>
        </li>
        <li>
            <a class="block py-2 px-3 dark:text-slate-200 transition-colors hover:dark:bg-slate-800"
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
