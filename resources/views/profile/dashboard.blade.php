<x-app-layout>
    <x-slot name="sidebar">
        <x-dash-menu />
    </x-slot>

    <h1 class="text-2xl dark:text-slate-100">{{ __('Your dashboard') }}</h1>

    <div class="mt-4 py-2 px-3 bg-zinc-200 dark:bg-slate-800 dark:text-slate-200 rounded-xl">
        @if ($posts > 0)
            <p class="text-lg">{{ __('You have created') }} {{ $posts }} {{ Str::of('post')->plural($posts) }}</p>
            <a class="btn-primary mt-2" href="{{ route('user.post.index') }}">{{ __('View your posts') }}</a>
        @else
            <p class="text-lg">{{ __('You have not created any posts') }}</p>
            <a class="btn-primary mt-2" href="{{ route('user.post.create') }}">{{ __('Add post') }}</a>
        @endif
    </div>
</x-app-layout>
