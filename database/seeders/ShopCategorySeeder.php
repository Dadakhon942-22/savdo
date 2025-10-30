<?php

namespace Database\Seeders;

use App\Models\ShopCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Oziq-ovqat',
                'slug' => 'oziq-ovqat',
                'description' => 'Oziq-ovqat do\'konlari',
            ],
            [
                'name' => 'Kiyim-kechak',
                'slug' => 'kiyim-kechak',
                'description' => 'Kiyim va aksessuarlar',
            ],
            [
                'name' => 'Elektronika',
                'slug' => 'elektronika',
                'description' => 'Elektronika va texnika',
            ],
            [
                'name' => 'Uy-ro\'zg\'or',
                'slug' => 'uy-rozgor',
                'description' => 'Uy uchun buyumlar',
            ],
            [
                'name' => 'Sport va salomatlik',
                'slug' => 'sport-salomatlik',
                'description' => 'Sport anjomlari va salomatlik uchun',
            ],
        ];

        foreach ($categories as $category) {
            ShopCategory::create($category);
        }
    }
}
