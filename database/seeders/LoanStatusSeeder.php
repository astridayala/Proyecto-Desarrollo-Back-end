<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loan_status')->insert([
            [
                'loan_statu_name' => 'Libre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'loan_statu_name' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'loan_statu_name' => 'Devuelto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'loan_statu_name' => 'Vencido',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}