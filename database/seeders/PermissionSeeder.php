<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Create roles
         */
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $bibliotecario = Role::firstOrCreate(['name' => 'bibliotecario', 'guard_name' => 'web']);
        $usuario = Role::firstOrCreate(['name' => 'usuario', 'guard_name' => 'web']);

        /**
         * Create permissions
         */
        $permissions = [
            // Permisos para usuario
            'ver catalogo',
            'reservar libro',
            'consultar estado de prestamos',
            'devolver libro',
            
            // Permisos para bibliotecario
            'gestionar libros', // CRUD libros
            'gestionar reservas',
            'gestionar prestamos',
            'gestionar devoluciones',
            'gestionar sanciones',
            
            // Permisos para administrador
            'gestionar usuarios',
            'asignar roles',
            'configurar reglas de prestamo'
        ];

        collect($permissions)->each(function ($permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        });

        /**
         * Assign permissions to roles
         */
        $usuario->givePermissionTo(['ver catalogo', 'reservar libro', 'consultar estado de prestamos', 'devolver libro']);
        
        $bibliotecario->givePermissionTo(['gestionar libros', 'gestionar reservas', 'gestionar prestamos', 'gestionar devoluciones', 'gestionar sanciones']);
        
        $admin->givePermissionTo(Permission::all()); // Admin tiene todos los permisos

        /**
         * Create users
         */
        $adminUser = User::firstOrCreate([
            'email' => 'admin@example.com',
        ],[
            'name' => 'Admin',
            'password' => bcrypt('password'),
        ]);

        $bibliotecarioUser = User::firstOrCreate([
            'email' => 'bibliotecario@example.com',
        ],[
            'name' => 'Bibliotecario',
            'password' => bcrypt('password'),
        ]);

        $usuarioUser = User::firstOrCreate([
            'email' => 'usuario@example.com',
        ],[
            'name' => 'Usuario',
            'password' => bcrypt('password'),
        ]);

        /**
         * Assign roles
         */
        $adminUser->assignRole($admin);
        $bibliotecarioUser->assignRole($bibliotecario);
        $usuarioUser->assignRole($usuario);
    }
}
