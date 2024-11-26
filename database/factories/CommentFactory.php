<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
        /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->date('Y-m-d h:m:s');
        return [
            'comment'=>fake()->paragraph(6),
            'ip_address'=>fake()->ipv4(),
            'status'=>rand(0,1),
            'user_id'=>User::inRandomOrder()->first()->id,
            'post_id'=>Post::inRandomOrder()->first()->id,
            'created_at'=>$date,
            'updated_at'=>$date,
        ];
    }
}
