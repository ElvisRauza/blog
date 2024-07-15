<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $posts = $request->user()->posts()->orderBy('created_at', 'desc')->paginate();

        return view('profile.post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Cache::remember('categories', 60 * 60 * 24, function () {
            return Category::all();
        });

        return view('profile.post.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserPostRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['title'] = strip_tags($validated['title']);
        $validated['body'] = strip_tags($validated['body']);

        $post = $request->user()->posts()->create($validated);

        $post->categories()->attach($validated['categories']);

        Cache::forget('latest_posts');

        return redirect(route('user.post.index'))->with('message', 'Post created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        Gate::authorize('update', $post);

        $post = $post->load('categories');

        $categories = Cache::remember('categories', 60 * 60 * 24, function () {
            return Category::all();
        });

        return view('profile.post.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserPostRequest $request, Post $post): RedirectResponse
    {
        Gate::authorize('update', $post);

        $validated = $request->validated();

        $validated['title'] = strip_tags($validated['title']);
        $validated['body'] = strip_tags($validated['body']);

        $post->update($validated);

        $post->categories()->sync($validated['categories']);

        return redirect(route('user.post.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        Gate::authorize('delete', $post);

        $post->categories()->detach();
        $post->delete();

        Cache::forget('latest_posts');

        return redirect(route('user.post.index'))->with('message', 'Post deleted');
    }

    /**
     * Dashboard controller
     */
    public function dashboard(Request $request)
    {
        $posts = Post::where('user_id', $request->user()->id)->count();

        return view('profile.dashboard', [
            'posts' => $posts,
        ]);
    }
}
