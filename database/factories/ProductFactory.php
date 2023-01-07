<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->realText(),
            'price' => $this->faker->numberBetween(0, 1000),
            'width' => $this->faker->numberBetween(),
            'height' => $this->faker->numberBetween(),
            'weight' => $this->faker->numberBetween(),
        ];
    }
}
