<x-app-layout>
    <section class="mt-24 flex items-center">
        <div class="container">
            <h1 class="dark:text-slate-100 text-5xl text-center">Welcome to blog</h1>
        </div>
    </section>

    @if (0 < $categories->count())
        <section class="container mt-16">
            <h2 class="text-3xl dark:text-slate-200">Explore our categories</h2>

            <div class="mt-4 grid grid-cols-3 gap-3">
                @foreach ($categories as $category)
                    <article>
                        <a href="{{ route('blog.index') }}?category={{ $category->id }}"
                            class="block bg-slate-200 dark:bg-slate-600 dark:text-slate-100 p-4 rounded-md border border-slate-800 transition-colors hover:slate-300 dark:hover:bg-slate-700">
                            <p>{{ $category->name }}</p>
                        </a>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <section class="container mt-16">
        <h2 class="text-3xl dark:text-slate-200">Latests posts</h2>

        @if (0 < $latestPosts->count())
            <div class="grid grid-cols-2 gap-2 mt-4">
                @foreach ($latestPosts as $post)
                    <article>
                        <a class="block p-3 dark:bg-slate-700 dark:text-slate-200 dark:hover:bg-slate-800 rounded-md"
                            href="{{ route('blog.show', $post->id) }}">
                            <h3>{{ $post->title }}</h3>
                        </a>
                    </article>
                @endforeach
            </div>
        @else
            <p>No latest posts</p>
        @endif

        <div class="mt-4">
            <a href="{{ route('blog.index') }}" class="btn-primary">View all posts</a>
        </div>
    </section>
</x-app-layout>
