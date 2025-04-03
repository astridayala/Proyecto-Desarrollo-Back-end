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
        $admin = Role::firstOrCreate(['name' => 'admin','guard_name' => 'web']);
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
            'name' => 'Ricardo Cubias',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '123456789'
        ]);
        $userAdmin->assignRole($admin);
        $adminToken = $userAdmin->createToken('admin-token')->plainTextToken;
        $this->command->info('Admin Token: ' . $adminToken);

        $userBibliotecario = User::firstOrCreate([
            'name' => 'Marjorie Monson',
            'email' => 'bibliotecario@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '987654321'
        ]);
        $userBibliotecario->assignRole($bibliotecario);
        $bibliotecarioToken = $userBibliotecario->createToken('bibliotecario-token')->plainTextToken; 
        $this->command->info('Bibliotecario Token: ' . $bibliotecarioToken);

        $userNormal = User::firstOrCreate([
            'name' => 'Daniela Guardado',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '112233445'
        ]);
        $userNormal->assignRole($usuario);
        $regularToken = $userNormal->createToken('user-token')->plainTextToken; 
        $this->command->info('User Token: ' . $regularToken);
    }
}
