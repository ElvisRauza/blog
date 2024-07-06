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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

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
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $validated = $request->validate([
            'post_id' => 'required|int',
        ]);

        $comment->delete();

        return redirect(route('blog.show', $validated['post_id']))->with('message', 'Comment deleted');
    }
}
