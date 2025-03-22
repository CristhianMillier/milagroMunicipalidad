<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CargoSeeder::class);
        $this->call(ContratoSeeder::class);
        $this->call(Tipo_PlantillaSeeder::class);
        $this->call(RegimeneSeeder::class);
    }
}