<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $validated = $request->validated();

        $post = Post::findOrFail($validated['post_id']);

        $comment = Comment::make($validated);
        $comment->user()->associate($request->user());
        $comment->post()->associate($post);
        $comment->save();


        return redirect(route('blog.show', $validated['post_id']))
            ->with('message', 'Commect created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $validated = $request->validate([
            'post_id' => 'required|integer|exists:posts.id',
        ]);

        $comment->delete();

        return redirect(route('blog.show', $validated['post_id']))->with('message', 'Comment deleted');
    }
}
