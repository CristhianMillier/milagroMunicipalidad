<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contrato;

class ContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contrato::insert([
            [
                'nombre' => 'NOMBRADO'
            ],
            [
                'nombre' => 'CONTRATO PERMANENTE'
            ],
            [
                'nombre' => 'ALCALDE'
            ],
            [
                'nombre' => 'DESIGNACIÓN AL CARGO'
            ],
            [
                'nombre' => 'CAS'
            ],
            [
                'nombre' => '276'
            ]
        ]);
    }
}