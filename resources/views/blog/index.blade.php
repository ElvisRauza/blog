<x-app-layout>
    <section class="container">
        <h1 class="hidden">{{ __('Explore our blog') }}</h1>

        <form class="mt-4 md:flex md:gap-2" action="{{ route('blog.index') }}" method="GET" x-data x-ref="filter">
            <div class="flex gap-2">
                <input class="input" type="text" name="search" placeholder="Enter text..."
                    value="{{ $search }}">
                <button class="btn-secondary">{{ __('Search') }}</button>
            </div>

            <select class="mt-2 md:mt-0 input cursor-pointer ml-auto" name="category"
                x-on:change="$refs.filter.submit()">
                <option value="">{{ __('All') }}</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @selected($cat->id == $category)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </form>

        <div class="mt-8">
            @if ($search && 0 == $posts->count())
                <p class="text-xl dark:text-slate-200">{{ __('Your search did not match any records') }}</p>
            @elseif(0 == $posts->count())
                <p class="text-xl dark:text-slate-200">{{ __('No blog posts found') }}</p>
            @else
                <div class="mt-8 sm:grid sm:gap-4 sm:grid-cols-2 md:grid-cols-4">
                    @foreach ($posts as $post)
                        <x-blog-article :post="$post" />
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </section>
</x-app-layout>
