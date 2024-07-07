<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Cache::get('categories', function () {
            return Category::all();
        });

        return view('home', [
            'categories' => $categories,
            'latestPosts' => $this->getLatestPosts(),
        ]);
    }

    private function getLatestPosts()
    {
        return Cache::get('latest_posts', function () {
            return Post::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        });
    }
}
