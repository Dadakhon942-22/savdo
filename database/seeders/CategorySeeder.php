<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronika', 'description' => 'Telefonlar, kompyuterlar va boshqa elektronika mahsulotlari'],
            ['name' => 'Kiyim-kechak', 'description' => 'Erkak, ayol va bolalar kiyimlari'],
            ['name' => 'Oziq-ovqat', 'description' => 'Turli xil oziq-ovqat mahsulotlari'],
            ['name' => 'Uy-ro\'zg\'or buyumlari', 'description' => 'Uy va ofis uchun buyumlar'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
