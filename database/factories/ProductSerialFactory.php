<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSerial>
 */
class ProductSerialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1,10),
            'title' => $this->faker->word(),
            'code' => $this->faker->numerify('pdt-sr-#####'),
            'status' => 'active',
        ];
    }
}
