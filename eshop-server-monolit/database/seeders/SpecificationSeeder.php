<?php

namespace Database\Seeders;

use App\Models\Specification;
use Illuminate\Database\Seeder;

class SpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specification::factory()->count(120)->create();
        Specification::factory()->count(120)
            ->create(['name' => 'Displej',
                      'description' => 'Impozantný 6,2 palcový Infinity-O displej Galaxy S21 5G prináša živé detaily aj za jasného
                       svetla. Eye Comfort Shield2 znižuje vyžarovanie modrého svetla a Real Smooth udržuje hladký
                       obraz, či už hráte alebo scrollujete.',
                      'image_src' => 'img/display.jpg']);
        Specification::factory()->count(120)
            ->create(['name' => 'Výdrž',
                      'description' => 'Batéria s vysokou kapacitou 4 000 mAh zaisťuje dlhú výdrž. Určite oceníte aj podporu rýchleho
                       nabíjania, ktorej zásluhou dodáte 100 % energie za iba 59 minút.',
                      'image_src' => 'img/battery.png']);
    }
}
