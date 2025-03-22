<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin#2024'),
        ]);

        $rol = Role::create(['name' => 'ADMINISTRADOR']);
        $permission = Permission::pluck('id', 'id')->all();
        $rol->syncPermissions($permission);
        $user->assignRole('ADMINISTRADOR');
    }
}