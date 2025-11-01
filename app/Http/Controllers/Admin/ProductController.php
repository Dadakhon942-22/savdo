<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $query = Product::with('category');
        
        // Savdogar faqat o'z mahsulotlarini ko'radi
        if (Auth::user()->isSeller()) {
            $query->where('user_id', Auth::id());
        }
        // Admin barchasini ko'radi
        
        $products = $query->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_uz' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description_uz' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        // Slug uchun O'zbekcha nom ishlatiladi
        $data['name'] = $request->name_uz; // Backward compatibility
        $data['description'] = $request->description_uz ?? null; // Backward compatibility
        $data['slug'] = Str::slug($request->name_uz);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Savdogar bo'lsa user_id qo'shish
        if (Auth::user()->isSeller()) {
            $data['user_id'] = Auth::id();
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        // Savdogar faqat o'z mahsulotlarini tahrirlashi mumkin
        if (Auth::user()->isSeller() && $product->user_id !== Auth::id()) {
            abort(403, 'Bu mahsulotni tahrirlash huquqingiz yo\'q');
        }
        
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        // Savdogar faqat o'z mahsulotlarini yangilashi mumkin
        if (Auth::user()->isSeller() && $product->user_id !== Auth::id()) {
            abort(403, 'Bu mahsulotni yangilash huquqingiz yo\'q');
        }

        $request->validate([
            'name_uz' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description_uz' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        // Slug uchun O'zbekcha nom ishlatiladi
        $data['name'] = $request->name_uz; // Backward compatibility
        $data['description'] = $request->description_uz ?? null; // Backward compatibility
        $data['slug'] = Str::slug($request->name_uz);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        // Savdogar faqat o'z mahsulotlarini o'chirishi mumkin
        if (Auth::user()->isSeller() && $product->user_id !== Auth::id()) {
            abort(403, 'Bu mahsulotni o\'chirish huquqingiz yo\'q');
        }

        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
}
