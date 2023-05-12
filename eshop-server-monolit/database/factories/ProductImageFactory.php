<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        static $product_id = 1;

        if ($product_id > 120) {
            $product_id = 1;
        }

        return [
            'image_src' => 'img/iphone.png',
            'main_img' => true,
            'product_id' => $product_id++
        ];
    }
}
