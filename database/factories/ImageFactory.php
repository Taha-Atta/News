<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
        /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Image::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->date('Y-m-d h:m:s');
        $paths = ['test/1.jpg','test/2.jpg','test/3.jpg','test/4.jpg','test/5.jpg','test/6.jpg','test/7.jpg',
                    'test/8.jpg','test/9.webp','test/10.webp','test/11.jpg','test/12.jpg'];
        return [
            'path'=>fake()->randomElement($paths),
            'created_at'=>$date,
            'updated_at'=>$date,
        ];
    }
}
