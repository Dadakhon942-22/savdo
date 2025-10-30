<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->with(['shop', 'category'])
            ->latest()
            ->paginate(12);

        return view('categories.show', compact('category', 'products'));
    }
}
