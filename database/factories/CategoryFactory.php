<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Laptop',
                'Smartphone',
                'Monitor',
                'Keyboard',
                'Router',
                'Headset',
                'Printer',
                'Camera',
                'Projector',
                'Server',
                'Desk',
                'Chair',
                'Cabinet',
                'Scanner',
                'Adapter',
                'Battery',
                'Tablet',
                'Microphone',
                'Speaker',
                'Webcam'
            ]),
            'description' => fake()->sentence(),
        ];
    }
}
