<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            /* 'titulo' => $this->faker->sentence(5),
            'descripcion' => $this->faker->sentence(20),
            'imagen' => $this->faker->uuid() . '.jpg',
            'user_id' => $this->faker->randomElement([2, 3, 4, 5, 6, 7, 8, 9]) */

            'titulo' => $this->faker->sentence(5),
            'descripcion' => $this->faker->sentence(20),
            'imagen' => $this->faker->randomElement(['c8adaf43-cc79-4bd5-b540-8aa9d7337a3d.jpg', 'd40f3306-0947-447b-af31-1f9dab70ff2a.jpg', '05841ef0-9f29-4a3b-91de-780b7c0b9756.jpg']),
            'user_id' => $this->faker->randomElement([2])

        ];
    }
}
