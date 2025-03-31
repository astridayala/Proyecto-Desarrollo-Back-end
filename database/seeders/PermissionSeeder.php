<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $bibliotecario = Role::firstOrCreate(['name' => 'bibliotecario', 'guard_name' => 'web']);
        $usuario = Role::firstOrCreate(['name' => 'usuario', 'guard_name' => 'web']);

        // Crear permisos
        $permissions = [
            'ver libros',
            'prestar libros',
            'devolver libros',
            'gestionar usuarios'
        ];

        foreach ($permissions as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }

        // Asignar permisos a roles
        $admin->givePermissionTo(Permission::all());
        $bibliotecario->givePermissionTo(['ver libros', 'prestar libros', 'devolver libros']);
        $usuario->givePermissionTo('ver libros');

        // Crear usuarios de prueba
        $userAdmin = User::firstOrCreate([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'telephone' => '123456789',
            'password' => Hash::make('password'),
        ]);
        $userAdmin->assignRole($admin);

        $userBibliotecario = User::firstOrCreate([
            'name' => 'Bibliotecario',
            'email' => 'biblio@example.com',
            'telephone' => '987654321',
            'password' => Hash::make('password'),
        ]);
        $userBibliotecario->assignRole($bibliotecario);

        $userNormal = User::firstOrCreate([
            'name' => 'Usuario Normal',
            'email' => 'user@example.com',
            'telephone' => '555666777',
            'password' => Hash::make('password'),
        ]);
        $userNormal->assignRole($usuario);
    }
}
