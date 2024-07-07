<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Elvis',
            'email' => 'elvis.rauza@gmail.com',
            'password' => Hash::make('password')
        ]);

        collect([
            'Tech',
            'Education',
            'Other'
        ])->each(function ($cat) {
            Category::create([
                'name' => $cat,
            ]);
        });

        $this->call([
            UserSeeder::class,
            PostSeeder::class
        ]);
    }
}
