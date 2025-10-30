<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $products = Product::where('shop_id', $shop->id)
            ->with('category')
            ->latest()
            ->paginate(10);
            
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['user_id'] = $user->id;
        $validated['shop_id'] = $shop->id;
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('seller.products.index')
            ->with('success', __('messages.product_created'));
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

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
