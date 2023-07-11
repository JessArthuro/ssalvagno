<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmbarcacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boats = [
            ['nombre' => 'Atalaya'],
            ['nombre' => 'Atlantic Osprey'],
            ['nombre' => 'V-PEMEX2023-C-C3-5'],
        ];

        DB::table('embarcaciones')->insert($boats);
    }
}
