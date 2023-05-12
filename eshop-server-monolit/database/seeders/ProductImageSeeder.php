<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductImage::factory()->count(120)->create();
        ProductImage::factory()->count(120)
            ->create(['image_src' => 'img/iphone-next.png',
                      'main_img' => false]);
        ProductImage::factory()->count(120)
            ->create(['image_src' => 'img/iphone-next-next.png',
                      'main_img' => false]);
    }
}
