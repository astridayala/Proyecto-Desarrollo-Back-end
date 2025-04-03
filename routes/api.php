<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\FineController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Librarian\LoanController;
use App\Http\Controllers\Librarian\ReturnController;



//Route::middleware('auth:sanctum')->group(function () {//

//RUTASS DEL ADMINISTRADOR
Route::prefix('admin/books')->group(function () {
    //lista de todos los libros
    Route::get('/', [BookController::class, 'index']);
    //crea nuevo libro
    Route::post('/', [BookController::class, 'store']);
    //actualiza un libro creado por el ID
    Route::put('/{id}', [BookController::class, 'update']);
    //eliminar libro
    Route::delete('/{id}', [BookController::class, 'destroy']);
});

Route::prefix('admin/fines')->group(function () {
        //lista de todas las multas
        Route::get('/', [FineController::class, 'index']);
        //crea nuevo libro
        Route::post('/', [FineController::class, 'store']);
        //elimina multa
        Route::delete('/{id}', [FineController::class, 'destroy']);
});

Route::prefix('admin/users')->group(function () {
    //lista de los usuarios
    Route::get('/', [UserController::class, 'index']);
    //crea nuevo usuario
    Route::post('/', [UserController::class, 'store']);
    //actualiza usuario creado por ID
    Route::put('/{id}', [UserController::class, 'update']);
    //elimina usuario
    Route::delete('/{id}', [UserController::class, 'destroy']);
    //asigna rol a usuario creado por ID
    Route::post('/{id}/role', [UserController::class, 'assignRole']);
});

//RUTAS DEL BIBLIOTECARIO
Route::prefix('librarian/books')->group(function () {
    //lista de los libros
    Route::get('/', [BookController::class, 'index']);
    //crea un nuevo libro
    Route::post('/', [BookController::class, 'store']);
    //obtiene detalles del libro
    Route::get('/{id}', [BookController::class, 'show']);
    //actualiza libro creado por ID
    Route::put('/{id}', [BookController::class, 'update']);
    //elimina libro
    Route::delete('/{id}', [BookController::class, 'destroy']);
});
Route::prefix('librarian/fines')->group(function () {
    //obtiene multas
    Route::get('/', [FineController::class, 'index']);
    //crea multa
    Route::post('/', [FineController::class, 'store']);
    //eliminar multa
    Route::delete('/{id}', [FineController::class, 'destroy']);
});
Route::prefix('librarian/loans')->group(function () {
    //crea prestamo
    Route::post('/', [LoanController::class, 'store']);
    //finaliza|cancela prestamo
    Route::put('/{id}/cancel', [LoanController::class, 'cancel']);
});
Route::prefix('librarian/returns')->group(function () {
    //marca prestamo como devuelto
    Route::post('/', [ReturnController::class, 'store']);
});

//RUTAS DEL USUARIO



// Ruta protegida con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/loans', [App\Http\Controllers\User\LoanController::class, 'index']);
});