<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Samsung Galaxy S21, 5G 8GB/128GB/6.2"',
            'category' => 'samsung',
            'top_product' => false,
            'best_price' => false,
            'discount' => false,
            'price' => '999.99',
            'short_description' => '6.2" AMOLED 2400 × 1080, 120Hz, procesor Qualcomm Snapdragon 8- jadrový, RAM 8GB,
                interná pamäť 128GB, MicroSD až 1000 GB, zadný fotoaparát 64Mpx (f/1.8)+12Mpx (f/2.2)+5Mpx (f/2.4)+5Mpx
                (f/2.4) , predný fotoaparát 32Mpx, optická stabilizácia, GPS',
            'available_amount' => '50'
        ];
    }
}
