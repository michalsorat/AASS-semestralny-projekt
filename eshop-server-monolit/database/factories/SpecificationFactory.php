<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpecificationFactory extends Factory
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
            'name' => 'Výkonný procesor',
            'description' => 'Procesor Qualcomm Snapdragon ponúka špičkovú energetickú účinnosť, výkon a 5G konektivitu.
                                  Výkonná čipová sada umožňuje rýchlejšie pripojenie, optimalizované hranie hier a lepšie
                                  spracovanie obrazu za cenu, ktorú nikde inde nenájdete.',
            'image_src' => 'img/processor.jpg',
            'product_id' => $product_id++
        ];
    }
}
