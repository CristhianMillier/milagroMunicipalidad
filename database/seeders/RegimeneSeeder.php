<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Regimene;

class RegimeneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Regimene::insert([
            [
                'nombre' => 'NIVEL REM',
                'tipo_regimene' => 'STA.'
            ],
            [
                'nombre' => 'NIVEL REM',
                'tipo_regimene' => 'SAA.'
            ],
            [
                'nombre' => 'REG LAB',
                'tipo_regimene' => '276'
            ],
            [
                'nombre' => 'REG LAB',
                'tipo_regimene' => '1057'
            ]
        ]);
    }
}