<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Symfony\Component\String\b;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            // DocumentSeeder::class,
            ArchiveClassificationSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
