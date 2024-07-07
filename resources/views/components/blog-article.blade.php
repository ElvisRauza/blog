@props(['post'])

<article class="mt-4 md:mt-0 h-full">
    <a class="flex flex-col h-full justify-between bg-zinc-200 dark:bg-slate-800 dark:text-slate-200 transition hover:bg-slate-300 hover:dark:bg-slate-700 py-2 px-3 rounded-md"
        href="{{ route('blog.show', $post) }}">
        <h3 class="text-xl">{{ $post->title }}</h3>
        <p class="text-xs mb-2 dark:text-slate-400">
            <span>{{ $post->created_at->format('d. F, Y') }}</span>
            @if (0 < $post->categories->count())
                <span>in {{ $post->categories->pluck('name')->join(',') }}</span>
            @endif
        </p>

        <span class="text-sm mt-auto">Read more</span>
    </a>
</article>
