<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AuthorSeeder::class,
            CategorySeeder::class,
            EditorialSeeder::class,
            LoanStatusSeeder::class,
            FineStatusSeeder::class,
            BookSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            LoanSeeder::class,
        ]);
    }
}
