<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //samsung
        Product::factory()->count(20)->create();
        //apple
        Product::factory()->count(1)
            ->create(['name' => 'Apple iPhone X 12GB/512GB',
                      'category' => 'apple',
                      'top_product' => true,
                      'best_price' => true,
                      'discount' => true,
                      'price' => '1299.99']);
        Product::factory()->count(4)
            ->create(['name' => 'Apple iPhone X 8GB/256GB',
                      'category' => 'apple',
                      'price' => '1099.99']);

        Product::factory()->count(1)
            ->create(['name' => 'Apple iPhone X 12GB/128GB',
                      'category' => 'apple',
                      'top_product' => true,
                      'best_price' => true,
                      'discount' => true,
                      'price' => '1049.99']);
        Product::factory()->count(4)
            ->create(['name' => 'Apple iPhone X 8GB/128GB',
                      'category' => 'apple',
                      'price' => '899.99']);

        Product::factory()->count(1)
            ->create(['name' => 'Apple iPhone XS Max 12GB/512GB',
                      'category' => 'apple',
                      'top_product' => true,
                      'best_price' => true,
                      'discount' => true,
                      'price' => '1499.99']);
        Product::factory()->count(4)
            ->create(['name' => 'Apple iPhone XS Max 12GB/128GB',
                      'category' => 'apple',
                      'price' => '1359.99']);

        Product::factory()->count(1)
            ->create(['name' => 'Apple iPhone X mini 8GB/128GB',
                      'category' => 'apple',
                      'top_product' => true,
                      'best_price' => true,
                      'discount' => true,
                      'price' => '699.99']);
        Product::factory()->count(4)
            ->create(['name' => 'Apple iPhone X mini 4GB/128GB',
                      'category' => 'apple',
                      'price' => '549.99']);
        //others
        Product::factory()->count(20)
            ->create(['name' => 'Huawei P40 lite 128GB',
                'category' => 'huawei']);
        Product::factory()->count(20)
            ->create(['name' => 'Xiaomi Mi 11 256GB',
                'category' => 'xiaomi']);
        Product::factory()->count(20)
            ->create(['name' => 'OnePlus 8T 256 GB',
                'category' => 'oneplus']);
        Product::factory()->count(20)
            ->create(['name' => 'LG Velvet 4G 6GB/128GBB',
                'category' => 'lg']);

//        Product::factory()->count(20)->create();
//        Product::factory()->count(20)->create();
    }
}
