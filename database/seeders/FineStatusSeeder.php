<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FineStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fine_status')->insert([
            [
                'fine_status_name' => 'Activa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fine_status_name' => 'Pagada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fine_status_name' => 'Anulada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}