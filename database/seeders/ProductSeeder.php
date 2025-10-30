<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn('Avval kategoriyalarni yarating!');
            return;
        }

        $seller = User::where('role', 'seller')->first();
        $shop = Shop::first();

        if (!$seller || !$shop) {
            $this->command->warn('Avval sotuvchi va do\'kon yarating!');
            return;
        }

        $products = [
            [
                'name' => 'Smartphone X1',
                'description' => 'Kuchli processor va yaxshi kameraga ega smartfon',
                'price' => 2500000,
                'stock' => 15,
                'category_id' => 1,
                'is_on_sale' => true,
                'discount_percentage' => 25,
            ],
            [
                'name' => 'Laptop Pro',
                'description' => 'Ish uchun mos laptop',
                'price' => 5000000,
                'stock' => 8,
                'category_id' => 1,
                'is_on_sale' => true,
                'discount_percentage' => 15,
            ],
            [
                'name' => 'Qishki kurtka',
                'description' => 'Qalin va issiq qishki kurtka',
                'price' => 800000,
                'stock' => 20,
                'category_id' => 2,
                'is_on_sale' => true,
                'discount_percentage' => 30,
            ],
            [
                'name' => 'Non',
                'description' => 'Xomashyo non',
                'price' => 5000,
                'stock' => 100,
                'category_id' => 3,
                'is_on_sale' => false,
                'discount_percentage' => 0,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'user_id' => $seller->id,
                'shop_id' => $shop->id,
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'category_id' => $product['category_id'],
                'is_active' => true,
                'is_on_sale' => $product['is_on_sale'] ?? false,
                'discount_percentage' => $product['discount_percentage'] ?? 0,
            ]);
        }
    }
}
