<?php

namespace Database\Factories;

use App\Models\Clothe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clothe>
 */
class ClotheFactory extends Factory
{
    protected $model = Clothe::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'color' => $this->faker->colorName,
            'img' => 'https://a.lmcdn.ru/product/M/P/MP002XM085XD_17091779_1_v1_2x.jpg',
            'price' => $this->faker->numberBetween(1000, 5000)
        ];
    }
}
