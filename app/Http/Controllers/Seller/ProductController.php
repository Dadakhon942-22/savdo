<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        // Seller mahsulotlari (barcha - active va inactive)
        $products = Product::where('shop_id', $shop->id)
            ->with('category')
            ->latest()
            ->get();
            
        return view('seller.products.index', compact('products', 'shop'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        $categories = Category::all();
        return view('seller.products.create', compact('categories', 'shop'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_uz' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_uz' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
            'is_on_sale' => 'nullable|boolean',
            'discount_percentage' => 'nullable|numeric|min:0|max:99',
            'sale_duration_days' => 'nullable|integer|min:1|max:365',
        ]);

        $validated['user_id'] = $user->id;
        $validated['shop_id'] = $shop->id;
        $validated['name'] = $validated['name_uz']; // Backward compatibility
        $validated['description'] = $validated['description_uz'] ?? null; // Backward compatibility
        $validated['slug'] = Str::slug($validated['name_uz']);
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['is_on_sale'] = $request->has('is_on_sale') ? true : false;
        $validated['discount_percentage'] = $request->has('is_on_sale') && $request->discount_percentage ? $request->discount_percentage : 0;
        
        // Aksiya muddatini qo'shish (kun soni)
        if ($request->has('is_on_sale')) {
            if ($request->filled('sale_duration_days') && $request->sale_duration_days > 0) {
                $validated['sale_duration_days'] = $request->sale_duration_days;
                // sale_end_date ni yaratilgandan keyin hisoblanadi (creating eventda)
                // Lekin bu yerda ham hisoblaymiz
                $validated['sale_end_date'] = now()->addDays($request->sale_duration_days);
            } else {
                $validated['sale_duration_days'] = null;
                $validated['sale_end_date'] = null; // Cheksiz aksiya
            }
        } else {
            // Aksiya o'chirilganda muddatni ham o'chirish
            $validated['sale_duration_days'] = null;
            $validated['sale_end_date'] = null;
            $validated['discount_percentage'] = 0;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        try {
            $product = Product::create($validated);
            
            if (!$product || !$product->id) {
                return back()->withErrors(['error' => 'Mahsulot yaratilmadi'])->withInput();
            }

            return redirect()->route('seller.products.index')
                ->with('success', __('messages.product_created'));
        } catch (\Exception $e) {
            \Log::error('Product creation error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Xatolik yuz berdi: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);
        return view('seller.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::all();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_uz' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_uz' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
            'is_on_sale' => 'nullable|boolean',
            'discount_percentage' => 'nullable|numeric|min:0|max:99',
            'sale_duration_days' => 'nullable|integer|min:1|max:365',
        ]);

        $validated['name'] = $validated['name_uz']; // Backward compatibility
        $validated['description'] = $validated['description_uz'] ?? null; // Backward compatibility
        $validated['slug'] = Str::slug($validated['name_uz']);
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['is_on_sale'] = $request->has('is_on_sale') ? true : false;
        $validated['discount_percentage'] = $request->has('is_on_sale') && $request->discount_percentage ? $request->discount_percentage : 0;
        
        // Aksiya muddatini qo'shish (kun soni)
        if ($request->has('is_on_sale')) {
            if ($request->filled('sale_duration_days') && $request->sale_duration_days > 0) {
                $validated['sale_duration_days'] = $request->sale_duration_days;
                // sale_end_date ni yaratilgan vaqtdan boshlab hisoblaymiz
                $createdAt = $product->created_at ? Carbon::parse($product->created_at) : now();
                $calculatedEndDate = $createdAt->copy()->addDays($request->sale_duration_days);
                
                // Agar hisoblangan sana o'tmishda bo'lsa, hozirgi vaqtdan boshlab hisoblaymiz
                if ($calculatedEndDate->isPast()) {
                    $validated['sale_end_date'] = now()->addDays($request->sale_duration_days);
                } else {
                    $validated['sale_end_date'] = $calculatedEndDate;
                }
            } else {
                $validated['sale_duration_days'] = null;
                $validated['sale_end_date'] = null; // Cheksiz aksiya
            }
        } else {
            // Aksiya o'chirilganda muddatni ham o'chirish
            $validated['sale_duration_days'] = null;
            $validated['sale_end_date'] = null;
            $validated['discount_percentage'] = 0;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('seller.products.index')
            ->with('success', __('messages.product_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', __('messages.product_deleted'));
    }
}
