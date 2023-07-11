<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlimentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $foods = [
            ['nombre' => 'Desayuno', 'precio' => 120.00],
            ['nombre' => 'Comida', 'precio' => 140.00],
            ['nombre' => 'Cena', 'precio' => 120.00],
        ];

        DB::table('alimentos')->insert($foods);
    }
}
