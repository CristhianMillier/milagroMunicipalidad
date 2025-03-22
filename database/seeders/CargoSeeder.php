<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cargo;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cargo::insert([
            [
                'nombre' => 'CHOFER - OPERADOR'
            ],
            [
                'nombre' => 'RESP. MAQUINARIA'
            ],
            [
                'nombre' => 'GUARDIAN'
            ],
            [
                'nombre' => 'PARQUES Y JARDINES'
            ],
            [
                'nombre' => 'DISTRIBUCIÓN AGUA'
            ],
            [
                'nombre' => 'OPER. DE MAQ. PESADA'
            ],
            [
                'nombre' => 'TESORERÍA'
            ],
            [
                'nombre' => 'RESP. SIAF Y ABAST.'
            ],
            [
                'nombre' => 'SECRETARIA GENERAL'
            ],
            [
                'nombre' => 'FISCALIZACIÓN'
            ],
            [
                'nombre' => 'ALCALDE'
            ],
            [
                'nombre' => 'GERENTE MUNICIPAL'
            ],
            [
                'nombre' => 'CONTABILIDAD - PRESUPUESTO'
            ],
            [
                'nombre' => 'GERENTE DES. TERRIT. E INFRAESTRUCT.'
            ],
            [
                'nombre' => 'SECT. TEC. DEF. CIVIL'
            ],
            [
                'nombre' => 'RESIDOS SOLIDOS'
            ],
            [
                'nombre' => 'SECRET. CODISEC DEF. CIV.'
            ],
            [
                'nombre' => 'COMUNICACIONES - ALMACEN - RR.HH.'
            ],
            [
                'nombre' => 'AREA DE RENTAS'
            ],
            [
                'nombre' => 'SERVICIO DE AGUA'
            ],
            [
                'nombre' => 'OBRERO'
            ],
            [
                'nombre' => 'SECT. TEC. PAD'
            ]
        ]);
    }
}