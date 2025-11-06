<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        // Seller do'konida ishlatilayotgan kategoriyalar
        $categories = Category::whereHas('products', function($q) use ($shop) {
            $q->where('shop_id', $shop->id);
        })
        ->withCount(['products' => function($q) use ($shop) {
            $q->where('shop_id', $shop->id)
              ->where('is_active', true);
        }])
        ->latest()
        ->get();
            
        return view('seller.categories.index', compact('categories', 'shop'));
    }

    public function create()
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        return view('seller.categories.create', compact('shop'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        $validated = $request->validate([
            'name_uz' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_uz' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['name'] = $validated['name_uz']; // Backward compatibility
        $validated['description'] = $validated['description_uz'] ?? null; // Backward compatibility
        $validated['slug'] = Str::slug($validated['name_uz']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($validated);

        return redirect()->route('seller.categories.index')
            ->with('success', __('messages.category_created', [], app()->getLocale()));
    }

    public function edit(Category $category)
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        // Faqat seller do'konida ishlatilayotgan kategoriyalarni tahrirlash mumkin
        $hasProducts = Product::where('category_id', $category->id)
            ->where('shop_id', $shop->id)
            ->exists();
            
        if (!$hasProducts) {
            return redirect()->route('seller.categories.index')
                ->with('error', 'Bu kategoriya sizning do\'koningizda mavjud emas.');
        }

        return view('seller.categories.edit', compact('category', 'shop'));
    }

    public function update(Request $request, Category $category)
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        // Faqat seller do'konida ishlatilayotgan kategoriyalarni yangilash mumkin
        $hasProducts = Product::where('category_id', $category->id)
            ->where('shop_id', $shop->id)
            ->exists();
            
        if (!$hasProducts) {
            return redirect()->route('seller.categories.index')
                ->with('error', 'Bu kategoriya sizning do\'koningizda mavjud emas.');
        }

        $validated = $request->validate([
            'name_uz' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_uz' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['name'] = $validated['name_uz']; // Backward compatibility
        $validated['description'] = $validated['description_uz'] ?? null; // Backward compatibility
        $validated['slug'] = Str::slug($validated['name_uz']);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('seller.categories.index')
            ->with('success', __('messages.category_updated', [], app()->getLocale()));
    }

    public function destroy(Category $category)
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        // Faqat seller do'konida ishlatilayotgan kategoriyalarni o'chirish mumkin
        $hasProducts = Product::where('category_id', $category->id)
            ->where('shop_id', $shop->id)
            ->exists();
            
        if (!$hasProducts) {
            return redirect()->route('seller.categories.index')
                ->with('error', 'Bu kategoriya sizning do\'koningizda mavjud emas.');
        }

        // Agar kategoriyada boshqa do'konlarda mahsulotlar bo'lsa, faqat rasmni o'chirish
        $otherShopProducts = Product::where('category_id', $category->id)
            ->where('shop_id', '!=', $shop->id)
            ->exists();

        if (!$otherShopProducts && $category->image) {
            Storage::disk('public')->delete($category->image);
            $category->delete();
        } else {
            // Agar boshqa do'konlarda ham mahsulotlar bo'lsa, faqat rasmni o'chirish
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $category->update(['image' => null]);
            
            return redirect()->route('seller.categories.index')
                ->with('success', __('messages.category_image_deleted', [], app()->getLocale()));
        }

        return redirect()->route('seller.categories.index')
            ->with('success', __('messages.category_deleted', [], app()->getLocale()));
    }
}

