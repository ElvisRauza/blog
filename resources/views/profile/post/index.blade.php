<x-app-layout>
    <x-slot name="sidebar">
        <x-dash-menu />
    </x-slot>

    <div class="flex items-center justify-between">
        <h1 class="dark:text-slate-100 text-2xl">Your blog posts</h1>

        <a class="btn-secondary" href="{{route('post.create')}}">Add new</a>
    </div>

    <ul class="flex flex-col gap-3 mt-4">
        @for ($i = 0; $i < 6; $i++)
            <li>
                <article class="flex gap-2 justify-between dark:bg-slate-800 dark:text-slate-200 py-2 px-3 rounded-md">
                    <h3><a href="/edit">Post</a></h3>

                    <ul class="flex gap-2">
                        <li>
                            <a href="/view">View</a>
                        </li>
                        <li>
                            <a href="/delete">Delete</a>
                        </li>
                    </ul>
                </article>
            </li>
        @endfor
    </ul>
</x-app-layout>
