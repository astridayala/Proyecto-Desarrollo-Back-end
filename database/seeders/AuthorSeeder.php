<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            [
                'author_name' => 'Stephen King',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_name' => 'Agatha Christie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_name' => 'Sarah J. Mass',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_name' => 'Brandon Sanderson',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
