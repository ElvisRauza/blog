<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $users = User::select('id')->whereNot('id', 1)->get();

        $posts = Post::factory(50)->create([
            'user_id' => $users->random(1)->pluck('id')[0],
        ]);

        foreach ($posts as $post) {
            $random = $this->getRandomCategories($categories);

            $post->categories()->attach($random);

            Comment::factory(rand(1, 7))->create([
                'post_id' => $post['id'],
                'user_id' => $users->random(1)->pluck('id')[0]
            ]);
        }
    }

    private function getRandomCategories($categories)
    {
        $length = count($categories);

        $numElements = rand(1, min(3, $length));

        $start = rand(0, $length - $numElements);

        $random = array_slice($categories->toArray(), $start, $numElements);

        return array_column($random, 'id');
    }
}
