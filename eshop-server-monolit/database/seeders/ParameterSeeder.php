<?php

namespace Database\Seeders;

use App\Models\Parameter;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //samsung
        Parameter::factory()->count(20)->create();
        //apple
        Parameter::factory()->count(1)
            ->create(['screen_size' => '5.8',
                      'internal_storage' => '512',
                      'ram' => '12']);
        Parameter::factory()->count(4)
            ->create(['screen_size' => '5.8',
                      'internal_storage' => '256']);

        Parameter::factory()->count(1)
            ->create(['screen_size' => '5.8',
                      'internal_storage' => '128',
                      'ram' => '12']);
        Parameter::factory()->count(4)
            ->create(['screen_size' => '5.8',
                      'internal_storage' => '128']);

        Parameter::factory()->count(1)
            ->create(['screen_size' => '6.4',
                      'internal_storage' => '512',
                      'ram' => '12']);
        Parameter::factory()->count(4)
            ->create(['screen_size' => '6.4',
                      'internal_storage' => '128',
                      'ram' => '12']);

        Parameter::factory()->count(1)
            ->create(['screen_size' => '4.8',
                      'internal_storage' => '128']);
        Parameter::factory()->count(4)
            ->create(['screen_size' => '4.8',
                      'internal_storage' => '128',
                      'ram' => '4']);
        //others
        Parameter::factory()->count(80)->create();
    }
}
