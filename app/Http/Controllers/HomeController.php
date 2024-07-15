<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Cache::remember('categories', 60 * 60 * 24, function () {
            return Category::all();
        });

        return view('home', [
            'categories' => $categories,
            'latestPosts' => $this->getLatestPosts(),
        ]);
    }

    private function getLatestPosts()
    {
        return Cache::remember('latest_posts', 60 * 60 * 24, function () {
            return Post::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        });
    }
}
