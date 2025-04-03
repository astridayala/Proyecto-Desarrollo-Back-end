<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\FineController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Librarian\LoanController;
use App\Http\Controllers\Librarian\ReturnController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\LoanController as UserLoanController;
use App\Http\Controllers\AuthController; // Asegúrate de importar el controlador de autenticación

Route::post('login', [AuthController::class, 'login']); // Ruta de autenticación

Route::middleware(['auth:sanctum'])->group(function () {

    // Ruta para obtener la información del usuario autenticado
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Rutas del Administrador
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::prefix('books')->group(function () {
            Route::get('/', [BookController::class, 'index']);
            Route::post('/', [BookController::class, 'store']);
            Route::put('/{id}', [BookController::class, 'update']);
            Route::delete('/{id}', [BookController::class, 'destroy']);
        });
        
        Route::prefix('fines')->group(function () {
            Route::get('/', [FineController::class, 'index']);
            Route::post('/', [FineController::class, 'store']);
            Route::put('/{id}', [FineController::class, 'update']);
            Route::delete('/{id}', [FineController::class, 'destroy']);
        });
        
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'store']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
        });
    });

    // Rutas del Bibliotecario
    Route::prefix('librarian')->middleware('role:librarian')->group(function () {
        Route::prefix('loans')->group(function () {
            Route::get('/', [LoanController::class, 'index']);
            Route::post('/', [LoanController::class, 'store']);
            Route::put('/{id}', [LoanController::class, 'update']);
            Route::delete('/{id}', [LoanController::class, 'destroy']);
        });
        
        Route::prefix('returns')->group(function () {
            Route::get('/', [ReturnController::class, 'index']);
            Route::post('/', [ReturnController::class, 'store']);
        });
    });

    // Rutas de Usuarios (Acceso general)
    Route::prefix('user')->middleware('role:user')->group(function () {
        Route::prefix('books')->group(function () {
            Route::get('/my-books', [UserBookController::class, 'show']);
        });

        Route::prefix('loans')->group(function () {
            Route::get('/', [UserLoanController::class, 'index']);
        });
    });

});
