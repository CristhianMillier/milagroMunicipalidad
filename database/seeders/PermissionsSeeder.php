<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            //Cargo
            'Ver-Cargos',
            'Crear-Cargo',
            'Editar-Cargo',
            'Eliminar-Cargo',
            
            //Contrato
            'Ver-Contratos',
            'Crear-Contrato',
            'Editar-Contrato',
            'Eliminar-Contrato',
            
            //Laboral
            'Ver-Laborales',
            'Crear-Laboral',
            'Editar-Laboral',
            'Eliminar-Laboral',

            //Persona
            'Ver-Personas',
            'Crear-Persona',
            'Editar-Persona',
            'Eliminar-Persona',

            //Plantilla
            'Ver-Plantillas',
            'Crear-Plantilla',
            'Mostrar-Plantilla',
            'Eliminar-Plantilla',
            'Ver-Detalle-del-Trabajador-en-la-Plantilla',
            'Eliminar-el-Trabajador-de-la-Plantilla',
            'Exportar-Plantilla',

            //Remuneracion
            'Ver-Remuneraciones',
            'Crear-Remuneración',
            'Editar-Remuneración',
            'Eliminar-Remuneración',

            //Tipo Plantilla
            'Ver-Tipos-Plantillas',
            'Crear-Tipo-Plantilla',
            'Editar-Tipo-Plantilla',
            'Eliminar-Tipo-Plantilla',

            //Role
            'Ver-Roles',
            'Crear-Rol',
            'Editar-Rol',
            'Eliminar-Rol',

            //User
            'Ver-Usuarios',
            'Crear-Usuario',
            'Editar-Usuario',
            'Eliminar-Usuario',
        ];

        foreach ($permission as $item){
            Permission::create(['name' => $item]);
        }
    }
}