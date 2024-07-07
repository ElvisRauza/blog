<x-app-layout>
    <section class="container mt-8 dark:text-slate-200">
        <h1 class="text-4xl">{{ $post->title }}</h1>

        <div class="mt-2 text-sm">
            <p>{{ __('Created at:') }} {{ $post->created_at->format('d. F, Y') }}</p>
            <p class="mt-1">{{ __('Categories:') }} {{ $post->categories->pluck('name')->join(', ') }}</p>
        </div>

        <div class="mt-6">
            <p class="text-lg">{{ $post->body }}</p>
        </div>

        <div class="mt-6 flex">
            <div class="py-1 px-3 bg-zinc-200 dark:bg-slate-700 rounded-lg">
                <p class="text-xs">{{ __('Created by') }}</p>
                <p class="text-sm">{{ $post->user->name }}</p>
            </div>
        </div>
    </section>

    <section class="container mt-12">
        <h2 class="text-xl dark:text-slate-200">
            {{ __('Comments') }}
            @if (0 < $post->comments->count())
                <span class="text-sm">({{ $post->comments->count() }})</span>
            @endif
        </h2>


        <div>
            @if (0 == $post->comments->count())
                @auth
                    <p class="mt-1 dark:text-slate-200">{{ __('This post has no comments, be first to comment!') }}</p>
                @else
                    <p class="mt-1 dark:text-slate-200">{{ __('This post has no comments, login to comment!') }}</p>

                    <a class="btn-secondary mt-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endauth
            @else
                <ul class="mt-3">
                    @foreach ($post->comments as $comment)
                        <li class="py-2 px-3 mt-4 bg-zinc-200 dark:bg-slate-700 dark:text-slate-200 rounded-md">
                            <div class="flex justify-between">
                                <p class="text-xs dark:text-slate-400">{{ $comment->user->name }} commented at
                                    {{ $comment->created_at->format('H:i') }} on
                                    {{ $comment->created_at->format('d.m.y') }}
                                </p>
                                @if ($comment->user->is(auth()->user()))
                                    <button class="text-red-500 text-sm" x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-comment-deletion-{{ $comment->id }}')">{{ __('Delete') }}</button>
                                    <x-modal name="confirm-comment-deletion-{{ $comment->id }}" :show="$errors->comment->isNotEmpty()"
                                        focusable>
                                        <form class="p-6" method="POST"
                                            action="{{ route('comment.destroy', $comment) }}">
                                            @csrf
                                            @method('delete')

                                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                {{ __('Are you sure you want to delete this comment?') }}
                                            </h2>

                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Cancel') }}
                                                </x-secondary-button>

                                                <x-danger-button class="ms-3">
                                                    {{ __('Delete') }}
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                @endif
                            </div>
                            <p>{{ $comment->comment }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        @auth
            <form class="mt-4" method="POST" action="{{ route('comment.store') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div>
                    <x-input-label for="comment" :value="__('Your comment')" />
                    <textarea
                        class="block w-full resize-none mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        name="comment" id="comment" rows="3"></textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('comment')" />
                </div>

                <x-primary-button class="mt-2">{{ __('Comment') }}</x-primary-button>
            </form>
        @else
            <a class="btn-secondary mt-6" href="{{ route('login') }}">{{ __('Login to comment') }}</a>
        @endauth
    </section>
</x-app-layout>
