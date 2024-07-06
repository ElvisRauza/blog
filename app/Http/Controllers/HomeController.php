<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('home', [
            'categories' => $categories,
            'latestPosts' => $this->getLatestPosts(),
        ]);
    }

    private function getLatestPosts()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->take(5)->get();

        return $posts;
    }
}
