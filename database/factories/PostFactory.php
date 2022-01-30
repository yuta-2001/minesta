<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * 
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,4),
            'location' => $this->faker->city(),
            'fish_name' => $this->faker->name(),
            'fish_count' => $this->faker->numberBetween(1,10),
            'caption' => $this->faker->realText(50),
        ];
    }
}
