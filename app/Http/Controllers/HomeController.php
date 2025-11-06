<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Agar seller bo'lsa, faqat o'z mahsulotlarini ko'rsatish
        if (auth()->check() && auth()->user()->isSeller()) {
            $shop = auth()->user()->shops()->first();
            
            if ($shop) {
                // Seller mahsulotlari
                $products = Product::where('shop_id', $shop->id)
                    ->where('is_active', true)
                    ->with(['category', 'shop'])
                    ->latest()
                    ->paginate(12);
                
                // Seller aksiyali mahsulotlari (faqat faol aksiyalar)
                $saleProducts = Product::where('shop_id', $shop->id)
                    ->where('is_active', true)
                    ->where('is_on_sale', true)
                    ->where('discount_percentage', '>', 0)
                    ->where(function($q) {
                        $q->whereNull('sale_end_date')
                          ->orWhere('sale_end_date', '>=', now());
                    })
                    ->with(['category', 'shop'])
                    ->latest()
                    ->take(8)
                    ->get();
                
                // Seller uchun faqat shop mahsulotlari bo'lgan kategoriyalar
                $categories = Category::whereHas('products', function($q) use ($shop) {
                    $q->where('shop_id', $shop->id)
                      ->where('is_active', true);
                })
                ->withCount(['products' => function($q) use ($shop) {
                    $q->where('shop_id', $shop->id)
                      ->where('is_active', true);
                }])
                ->get();
            } else {
                $products = collect();
                $saleProducts = collect();
                $categories = collect();
            }
        } else {
            // Oddiy foydalanuvchilar uchun barcha mahsulotlar
            $categories = Category::withCount('products')->get();
            
            // Faol aksiya mahsulotlari (muddat tugamagan)
            $saleProducts = Product::where('is_active', true)
                ->where('is_on_sale', true)
                ->where('discount_percentage', '>', 0)
                ->where(function($q) {
                    $q->whereNull('sale_end_date')
                      ->orWhere('sale_end_date', '>=', now());
                })
                ->with(['category', 'shop'])
                ->latest()
                ->take(8)
                ->get();
            
            $products = Product::where('is_active', true)
                ->with(['category', 'shop'])
                ->latest()
                ->paginate(12);
        }
            
        return view('home', compact('categories', 'products', 'saleProducts'));
    }
}
