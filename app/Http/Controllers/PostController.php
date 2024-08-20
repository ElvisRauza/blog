<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'category' => 'nullable|integer|exists:categories,id',
            'search' => 'nullable|string|max:255',
        ]);

        // If has category
        if (isset($validated['category'])) {
            $posts = Category::find($validated['category'])->posts()->with(['user', 'comments', 'categories']);
        } else {
            $posts = Post::with(['user', 'comments', 'categories']);
        }

        // If has search
        if (isset($validated['search'])) {
            $posts = $posts->search($validated['search']);
        }

        $posts = $posts->orderBy('created_at', 'desc')
            ->paginate(16)
            ->appends($request->query());

        $categories = Cache::remember('categories', 60 * 60 * 24, function () {
            return Category::all();
        });

        return view('blog.index', [
            'search' => $validated['search'] ?? null,
            'posts' => $posts,
            'category' => $validated['category'] ?? null,
            'categories' => $categories,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = $post->load(['user', 'comments', 'comments.user']);

        return view('blog.show', [
            'post' => $post,
        ]);
    }
}
