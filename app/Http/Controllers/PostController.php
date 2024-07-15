<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
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

        $category_id = !empty($validated['category']) ? strip_tags($validated['category']) : 0;
        $search = !empty($validated['search']) ? strip_tags($validated['search']) : '';

        $posts = Post::with(['user', 'comments', 'categories']);

        $categories = Cache::remember('categories', 60 * 60 * 24, function () {
            return Category::all();
        });

        // If has category
        if ($category_id) {
            $posts = $posts->whereHas('categories', function (Builder $query) use ($category_id) {
                $query->where('categories.id', $category_id);
            });
        }

        // If has search
        if ($search) {
            $posts = $posts->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        }

        $posts = $posts->orderBy('created_at', 'desc')
            ->paginate(16)
            ->appends($request->query());

        return view('blog.index', [
            'search' => $search,
            'posts' => $posts,
            'category' => $category_id,
            'categories' => $categories,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = $post->load('user');

        return view('blog.show', [
            'post' => $post,
        ]);
    }
}
