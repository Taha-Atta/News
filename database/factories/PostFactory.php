<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
        /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->date('Y-m-d h:m:s');
        return [
            'title'=>fake()->sentence(3),
            // 'slug'=>fake()->sentence(6),
            'comment_able'=>rand(0,1),
            'status'=>rand(0,1),
            'description'=>fake()->paragraph(6),
            'num_of_views'=>rand(1,100),
            'user_id'=>User::inRandomOrder()->first()->id,
            'category_id'=>Category::inRandomOrder()->first()->id,
            'created_at'=>$date,
            'updated_at'=>$date,
        ];
    }
}
