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
        $posts = Post::with(['user', 'comments', 'categories']);

        $categories = Cache::get('categories', function () {
            return Category::all();
        });

        // If has category
        if ($request->get('category')) {
            $category_id = $request->input('category');

            $posts = $posts->whereHas('categories', function (Builder $query) use ($category_id) {
                $query->where('categories.id', $category_id);
            });
        } else {
            $category_id = 0;
        }

        // If has search
        if ($request->get('search')) {
            $search = $request->input('search');

            $posts = $posts->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        } else {
            $search = '';
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
