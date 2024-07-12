<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            '/assets/img/bg-img/1.jpg',
            '/assets/img/bg-img/2.jpg',
            '/assets/img/bg-img/3.jpg',
            '/assets/img/bg-img/4.jpg',
            '/assets/img/bg-img/5.jpg',
            '/assets/img/bg-img/6.jpg',
            '/assets/img/bg-img/7.jpg',
            '/assets/img/bg-img/8.jpg',
            '/assets/img/bg-img/9.jpg',
        ];
        return [
            // 'image' => $this->faker->imageUrl(640, 480, 'products', true),
            'image' => $this->faker->randomElement($images),
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'description' => $this->faker->text,
        ];
    }
}
