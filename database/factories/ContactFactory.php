<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
        /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->date('Y-m-d h:m:s');
        return [
            'name'=>fake()->name(),
            'email'=>fake()->email(),
            'title'=>fake()->title(),
            'phone'=>fake()->phoneNumber(),
            'ip_address'=>fake()->ipv4(),
            'body'=>fake()->paragraph(),
            'created_at'=>$date,
            'updated_at'=>$date,
        ];
    }
}
