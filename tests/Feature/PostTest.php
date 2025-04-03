<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba que un administrador pueda realizar operaciones CRUD en los libros.
     */
    public function test_admin_can_manage_books()
    {
        // Creamos un usuario con rol de administrador
        $admin = User::factory()->create(['role' => 'admin']);
        Sanctum::actingAs($admin); // Autenticamos al administrador

        // Verificamos que puede obtener la lista de libros
        $this->getJson('/api/admin/books')->assertStatus(200);

        // Verificamos que puede agregar un libro
        $this->postJson('/api/admin/books', ["title" => "Test Book"])->assertStatus(201);

        // Verificamos que puede actualizar un libro específico
        $this->putJson('/api/admin/books/1', ["title" => "Updated Title"])->assertStatus(200);

        // Verificamos que puede eliminar un libro
        $this->deleteJson('/api/admin/books/1')->assertStatus(200);
    }

    /**
     * Prueba que un administrador pueda administrar multas (fines).
     */
    public function test_admin_can_manage_fines()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Sanctum::actingAs($admin);

        // Obtener lista de multas
        $this->getJson('/api/admin/fines')->assertStatus(200);

        // Crear una nueva multa
        $this->postJson('/api/admin/fines', ["amount" => 10])->assertStatus(201);

        // Actualizar una multa existente
        $this->putJson('/api/admin/fines/1', ["amount" => 15])->assertStatus(200);

        // Eliminar una multa
        $this->deleteJson('/api/admin/fines/1')->assertStatus(200);
    }

    /**
     * Prueba que un administrador pueda administrar usuarios.
     */
    public function test_admin_can_manage_users()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Sanctum::actingAs($admin);

        // Obtener lista de usuarios
        $this->getJson('/api/admin/users')->assertStatus(200);

        // Crear un nuevo usuario
        $this->postJson('/api/admin/users', ["name" => "John Doe"])->assertStatus(201);

        // Actualizar un usuario existente
        $this->putJson('/api/admin/users/1', ["name" => "Updated Name"])->assertStatus(200);

        // Eliminar un usuario
        $this->deleteJson('/api/admin/users/1')->assertStatus(200);
    }

    /**
     * Prueba que un bibliotecario pueda administrar préstamos de libros.
     */
    public function test_librarian_can_manage_loans()
    {
        $librarian = User::factory()->create(['role' => 'librarian']);
        Sanctum::actingAs($librarian);

        // Obtener lista de préstamos
        $this->getJson('/api/librarian/loans')->assertStatus(200);

        // Crear un nuevo préstamo
        $this->postJson('/api/librarian/loans', ["book_id" => 1])->assertStatus(201);

        // Actualizar el estado de un préstamo
        $this->putJson('/api/librarian/loans/1', ["status" => "returned"])->assertStatus(200);

        // Eliminar un préstamo
        $this->deleteJson('/api/librarian/loans/1')->assertStatus(200);
    }

    /**
     * Prueba que un bibliotecario pueda administrar devoluciones de libros.
     */
    public function test_librarian_can_manage_returns()
    {
        $librarian = User::factory()->create(['role' => 'librarian']);
        Sanctum::actingAs($librarian);

        // Obtener lista de devoluciones
        $this->getJson('/api/librarian/returns')->assertStatus(200);

        // Registrar una nueva devolución
        $this->postJson('/api/librarian/returns', ["loan_id" => 1])->assertStatus(201);
    }

    /**
     * Prueba que un usuario pueda ver los libros que ha tomado en préstamo y sus préstamos activos.
     */
    public function test_user_can_view_books_and_loans()
    {
        $user = User::factory()->create(['role' => 'user']);
        Sanctum::actingAs($user);

        // Ver libros prestados al usuario
        $this->getJson('/api/user/books/my-books')->assertStatus(200);

        // Ver préstamos activos del usuario
        $this->getJson('/api/user/loans')->assertStatus(200);
    }
}
