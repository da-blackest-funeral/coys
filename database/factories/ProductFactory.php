<?php

namespace Database\Factories;

use App\Models\Clothe;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, User::count()),
            'clothe_id' => $this->faker->numberBetween(1, Clothe::count()),
            'size' => strtoupper($this->faker->randomElement(['xl', 'l', 'm', 's', 'xs'])),
        ];
    }
}
