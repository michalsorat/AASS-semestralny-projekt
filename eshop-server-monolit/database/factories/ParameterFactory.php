<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParameterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        static $product_id = 1;

        return [
            'screen_size' => '6.2',
            'screen_resolution' => '2400 x 1080 px',
            'screen_type' => 'AMOLED',
            'cpu_cores' => '8',
            'cpu_frequency' => '2.91',
            'ram' => '8',
            'internal_storage' => '128',
            'battery_capacity' => '4000',
            'back_camera_resolution' => '12+64+12 Mpx',
            'front_camera_resolution' => '10 Mpx',
            'max_video_resolution' => '8K Ultra HD',
            'operating_system' => 'Android 11',
            'connector' => 'USB-C',
            'network_connection' => '5G',
            'product_id' => $product_id++
        ];
    }
}
