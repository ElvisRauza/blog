<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::with(['user', 'comments', 'categories']);

        $categories = Category::all();

        // If has search
        if ($request->has('search')) {
            $validated = $request->validate([
                'search' => 'nullable|string',
            ]);

            $search = $validated['search'];

            $posts = $posts->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        } else {
            $search = '';
        }

        // If has category
        if ($request->has('category')) {
            $validated = $request->validate([
                'category' => 'nullable|int',
            ]);

            $category_id = $validated['category'];

            $posts = $posts->whereHas('categories', function ($cat) use ($category_id) {
                return $cat->where('categories.id', $category_id);
            });
        } else {
            $category_id = 0;
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
