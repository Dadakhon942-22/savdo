<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seller = User::where('role', 'seller')->first();
        $category = ShopCategory::first();

        if ($seller && $category) {
            Shop::create([
                'user_id' => $seller->id,
                'shop_category_id' => $category->id,
                'name' => 'Demo Do\'kon',
                'slug' => 'demo-dokon',
                'description' => 'Bu demo do\'kon',
                'phone' => '+998901234567',
                'address' => 'Toshkent, O\'zbekiston',
                'is_active' => true,
            ]);
        }
    }
}
