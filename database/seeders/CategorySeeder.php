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
            [
                'name' => 'Elektronika',
                'name_uz' => 'Elektronika',
                'name_ru' => 'Электроника',
                'name_en' => 'Electronics',
                'description' => 'Telefonlar, kompyuterlar va boshqa elektronika mahsulotlari',
                'description_uz' => 'Telefonlar, kompyuterlar va boshqa elektronika mahsulotlari',
                'description_ru' => 'Телефоны, компьютеры и другая электроника',
                'description_en' => 'Phones, computers and other electronic products',
            ],
            [
                'name' => 'Kiyim-kechak',
                'name_uz' => 'Kiyim-kechak',
                'name_ru' => 'Одежда',
                'name_en' => 'Clothing',
                'description' => 'Erkak, ayol va bolalar kiyimlari',
                'description_uz' => 'Erkak, ayol va bolalar kiyimlari',
                'description_ru' => 'Мужская, женская и детская одежда',
                'description_en' => 'Men\'s, women\'s and children\'s clothing',
            ],
            [
                'name' => 'Oziq-ovqat',
                'name_uz' => 'Oziq-ovqat',
                'name_ru' => 'Продукты питания',
                'name_en' => 'Food',
                'description' => 'Turli xil oziq-ovqat mahsulotlari',
                'description_uz' => 'Turli xil oziq-ovqat mahsulotlari',
                'description_ru' => 'Различные продукты питания',
                'description_en' => 'Various food products',
            ],
            [
                'name' => 'Uy-ro\'zg\'or buyumlari',
                'name_uz' => 'Uy-ro\'zg\'or buyumlari',
                'name_ru' => 'Товары для дома',
                'name_en' => 'Household Goods',
                'description' => 'Uy va ofis uchun buyumlar',
                'description_uz' => 'Uy va ofis uchun buyumlar',
                'description_ru' => 'Товары для дома и офиса',
                'description_en' => 'Items for home and office',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'name_uz' => $category['name_uz'],
                'name_ru' => $category['name_ru'],
                'name_en' => $category['name_en'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'description_uz' => $category['description_uz'],
                'description_ru' => $category['description_ru'],
                'description_en' => $category['description_en'],
            ]);
        }
    }
}
