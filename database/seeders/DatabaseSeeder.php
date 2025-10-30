<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Savdogar',
            'email' => 'seller@example.com',
            'role' => 'seller',
        ]);

        $this->call([
            ShopCategorySeeder::class,
            ShopSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
