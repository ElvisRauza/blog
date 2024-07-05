<x-app-layout>
    <section class="container mt-8 dark:text-slate-200">
        <h1 class="text-4xl">{{ $post->title }}</h1>

        <div class="mt-2 text-sm">
            <p>Created at: {{ $post->created_at->format('d. F, Y') }}</p>
            <p>Author: {{ $post->user->name }}</p>
        </div>

        <div class="mt-4">
            <p>{{ $post->body }}</p>
        </div>
    </section>

    <section>

    </section>
</x-app-layout>
