<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::with('user');

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

        $posts = $posts->orderBy('created_at', 'desc')
            ->paginate(16)
            ->appends($request->query());

        return view('blog.index', [
            'search' => $search,
            'posts' => $posts,
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
