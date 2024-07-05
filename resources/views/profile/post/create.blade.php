<x-app-layout>
    <x-slot name="sidebar">
        <x-dash-menu />
    </x-slot>

    <div class="flex items-center justify-between">
        <h1 class="dark:text-slate-100 text-2xl">Add new blog posts</h1>
    </div>

    <form class="max-w-lg" method="post" action="{{ route('user.post.store') }}">
        @csrf

        <div>
            <x-input-label for="title" :value="__('Name')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div class="mt-4">
            <x-input-label for="body" :value="__('Content')" />
            <textarea
                class="block w-full resize-none border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                id="body" name="body" rows="10"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('body')" />
        </div>

        <x-primary-button class="mt-4">Create</x-primary-button>
    </form>
</x-app-layout>