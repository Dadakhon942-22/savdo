<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        
        // Aksiyali mahsulotlar (chegirmadagi mahsulotlar)
        $saleProducts = Product::where('is_active', true)
            ->where('is_on_sale', true)
            ->where('discount_percentage', '>', 0)
            ->with(['category', 'shop'])
            ->latest()
            ->take(8)
            ->get();
        
        $products = Product::where('is_active', true)
            ->with(['category', 'shop'])
            ->latest()
            ->paginate(12);
            
        return view('home', compact('categories', 'products', 'saleProducts'));
    }
}
