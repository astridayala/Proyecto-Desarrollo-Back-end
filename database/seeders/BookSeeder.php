<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'It',
                'author_id' => 1, // stephen King
                'editorial_id' => 1, // penguin Random House
                'publication_date' => Carbon::create(1986, 9, 15),
                'ISBN' => '978-0670813025',
                'category_id' => 1, // terror
                'availability' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Murder on the Orient Express',
                'author_id' => 2, // agatha Christie
                'editorial_id' => 2, // harperCollins
                'publication_date' => Carbon::create(1934, 1, 1),
                'ISBN' => '978-0007119316',
                'category_id' => 2, // misterio
                'availability' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'A Court of Thorns and Roses',
                'author_id' => 3, // sarah J. Mass
                'editorial_id' => 3, // simon & Schuster
                'publication_date' => Carbon::create(2015, 5, 5),
                'ISBN' => '978-1619635180',
                'category_id' => 3, // fantasía
                'availability' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Way of Kings',
                'author_id' => 4, // brandon Sanderson
                'editorial_id' => 4, // hachette Livre
                'publication_date' => Carbon::create(2010, 8, 31),
                'ISBN' => '978-0765326355',
                'category_id' => 4, // ciencia Ficción
                'availability' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}