<x-app-layout>
    <section class="container">
        <h1 class="hidden">Explore our blog</h1>

        <form class="mt-4 flex gap-2" action="{{ route('blog.index') }}" method="Get">
            <input class="bg-slate-200 dark:text-slate-200 dark:bg-slate-800 rounded-md" type="text" name="search"
                placeholder="Enter text..." value="{{ $search }}">
            <button class="btn-secondary">Search</button>
        </form>

        <div class="mt-8">
            @if ($search && 0 == $posts->total())
                <p class="text-xl dark:text-slate-200">Your search did not match any records</p>
            @elseif(0 == $posts->total())
                <p class="text-xl dark:text-slate-200">No blog posts found</p>
            @else
                <div class="mt-8 sm:grid sm:gap-4 sm:grid-cols-2 md:grid-cols-4">
                    @foreach ($posts as $post)
                        <article class="h-full">
                            <a class="flex flex-col h-full justify-between dark:bg-slate-800 dark:text-slate-200 py-2 px-3 rounded-md"
                                href="{{ route('blog.show', $post) }}">
                                <h3 class="text-xl">{{ $post->title }}</h3>
                                <p class="text-xs mb-2 dark:text-slate-400">{{ $post->created_at->format('d. F, Y') }}
                                </p>
                                {{-- <p>{{ $post->excerpt }}</p> --}}

                                <span class="text-sm mt-auto">Read more</span>
                            </a>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </section>
</x-app-layout>