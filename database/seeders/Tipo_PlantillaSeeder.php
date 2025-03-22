<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipo_plantilla;

class Tipo_PlantillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipo_plantilla::insert([
            [
                'nombre' => 'PLANILLA  DE  NOMBRADOS - 276 '
            ],
            [
                'nombre' => 'PLANILLA  DE  JORNAL DE OBRERO D.L. Nº 728 '
            ],
            [
                'nombre' => 'PLANILLA  DE  ALCALDIA'
            ],
            [
                'nombre' => 'PLANILLA  DE  FUNCIONARIOS '
            ],
            [
                'nombre' => 'PLANILLA  DE  FUNCIONARIOS CAS'
            ],
            [
                'nombre' => 'PLANILLA  DE  PERMANENTE'
            ],
            [
                'nombre' => 'PLANILLA  DE  REPUESTOS MEDIDA CAUTELAR'
            ],
            [
                'nombre' => 'PLANILLA  DE  SECRETARIO TÉCNICO PAD.'
            ]
        ]);
    }
}