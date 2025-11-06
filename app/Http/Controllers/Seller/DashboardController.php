<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        // Seller mahsulotlari (barcha - active va inactive)
        $allProducts = Product::where('shop_id', $shop->id)
            ->with('category')
            ->latest()
            ->get();
        
        $productsTotal = $allProducts->count();

        // Seller kategoriyalari (faqat shop mahsulotlari bo'lgan)
        $categories = Category::whereHas('products', function($q) use ($shop) {
            $q->where('shop_id', $shop->id)
              ->where('is_active', true);
        })
        ->withCount(['products' => function($q) use ($shop) {
            $q->where('shop_id', $shop->id)
              ->where('is_active', true);
        }])
        ->get();
            
        return view('seller.dashboard', compact('shop', 'categories', 'productsTotal'));
    }
}

