<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;
use Carbon\Carbon;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Loan::create([
            // daniela guardado
            'user_id' => 3, 
            'book_id' => 1, // "it"
            'date_start_loan' => Carbon::now(),
            'date_end_loan' => Carbon::now()->addDays(14),
            'loanStatus_id' => 2, // Activo
        ]);

        Loan::create([
            'user_id' => 3, 
            'book_id' => 2, // "murder on the Orient Express"
            'date_start_loan' => Carbon::now()->subDays(7),
            'date_end_loan' => Carbon::now()->addDays(7),
            'loanStatus_id' => 2, // Activo
        ]);

        Loan::create([
            'user_id' => 3,
            'book_id' => 3, // "a court of thorns and roses"
            'date_start_loan' => Carbon::now()->subDays(20),
            'date_end_loan' => Carbon::now()->subDays(6),
            'loanStatus_id' => 3, // Devuelto
        ]);

        Loan::create([
            'user_id' => 3,
            'book_id' => 4, // "The Way of Kings"
            'date_start_loan' => Carbon::now()->subDays(30),
            'date_end_loan' => Carbon::now()->subDays(16),
            'loanStatus_id' => 4, // Vencido
        ]);
    }
}