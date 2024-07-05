<x-app-layout>
    <x-slot name="sidebar">
        <x-dash-menu />
    </x-slot>

    <div class="flex items-center justify-between">
        <h1 class="dark:text-slate-100 text-2xl">Your blog posts</h1>

        <a class="btn-secondary" href="{{ route('user.post.create') }}">Add new</a>
    </div>

    <ul class="flex flex-col gap-3 mt-4">
        @foreach ($posts as $post)
            <li>
                <article class="flex gap-2 justify-between bg-slate-200 dark:bg-slate-800 dark:text-slate-200 py-2 px-3 rounded-md">
                    <h3><a href="{{ route('user.post.edit', $post) }}">{{ $post->title }}</a></h3>

                    <ul class="flex gap-2">
                        <li>
                            <a href="{{ route('user.post.show', $post) }}">View</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('user.post.destroy', $post) }}">
                                @csrf
                                @method('delete')
                                <button type="submit">Delete</button>
                            </form>
                        </li>
                    </ul>
                </article>
            </li>
        @endforeach
    </ul>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</x-app-layout>
