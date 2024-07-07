<x-app-layout>
    <x-slot name="sidebar">
        <x-dash-menu />
    </x-slot>

    <div class="flex items-center justify-between">
        <h1 class="dark:text-slate-100 text-2xl">{{ __('Your blog posts') }}</h1>

        <a class="btn-secondary" href="{{ route('user.post.create') }}">{{ __('Add new') }}</a>
    </div>

    <ul class="flex flex-col gap-3 mt-4">
        @foreach ($posts as $post)
            <li>
                <article
                    class="flex gap-2 justify-between bg-slate-200 dark:bg-slate-800 dark:text-slate-200 py-2 px-3 rounded-md">
                    <h3><a href="{{ route('user.post.edit', $post) }}">{{ $post->title }}</a></h3>

                    <ul class="flex gap-2">
                        <li>
                            <a href="{{ route('user.post.edit', $post) }}">{{ __('Edit') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('blog.show', $post) }}">{{ __('View') }}</a>
                        </li>
                        <li>
                            <button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-post-deletion-{{ $post->id }}')">{{ __('Delete') }}</button>
                            <x-modal name="confirm-post-deletion-{{ $post->id }}" :show="$errors->post->isNotEmpty()" focusable>
                                <form class="p-6" method="POST" action="{{ route('user.post.destroy', $post) }}">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete this post?') }}
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
