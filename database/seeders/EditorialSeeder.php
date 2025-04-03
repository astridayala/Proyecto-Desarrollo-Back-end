<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EditorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('editorials')->insert([
            [
                'editorial_name' => 'Penguin Random House',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'editorial_name' => 'HarperCollins',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'editorial_name' => 'Simon & Schuster', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'editorial_name' => 'Hachette Livre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}