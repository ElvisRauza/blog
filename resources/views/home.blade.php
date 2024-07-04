<x-app-layout>
    <section class="mt-24 flex items-center">
        <div class="container">
            <h1 class="dark:text-slate-100 text-5xl text-center">Welcome to blog</h1>
        </div>
    </section>

    <section class="container mt-16">
        <h2 class="text-3xl dark:text-slate-200">Explore our categories</h2>

        <div class="mt-4 grid grid-cols-3 gap-3">
            @for ($i = 0; $i < 6; $i++)
                <article>
                    <a href=""
                        class="block bg-slate-200 dark:bg-slate-600 dark:text-slate-100 p-4 rounded-md border border-slate-800 transition-colors hover:slate-300 dark:hover:bg-slate-700">
                        <p>Name</p>
                    </a>
                </article>
            @endfor
        </div>
    </section>
</x-app-layout>
