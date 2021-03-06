<?php

namespace Database\Seeders;

use App\Models\Post;
// use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UsersTableSeeder::class,
            // PostsTableSeeder::class,
        ]);

        Post::factory(100)->create();
    }
}
