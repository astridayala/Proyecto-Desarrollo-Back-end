<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ruta protegida con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/loans', [App\Http\Controllers\User\LoanController::class, 'index']);
});
