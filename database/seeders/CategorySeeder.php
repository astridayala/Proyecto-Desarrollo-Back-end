<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_name' => 'Terror',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Misterio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Fantasía',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Ciencia Ficción',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
