<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Asegúrate de importar HasRoles

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // Agrega HasRoles aquí

    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone', // Asegúrate de agregar 'telephone' si lo usas en tu base de datos
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
