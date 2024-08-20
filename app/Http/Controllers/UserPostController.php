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
        $post = $request->user()->posts()->create([
            'title' => $request->validated('title'),
            'body' => $request->validated('body'),
        ]);

        $post->categories()->attach($request->validated('categories'));

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

        $post->update([
            'title' => $request->validated('title'),
            'body' => $request->validated('body'),
        ]);

        $post->categories()->sync($request->validated('categories'));

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
        return view('profile.dashboard', [
            'posts' => $request->user()->posts()->count(),
        ]);
    }
}
