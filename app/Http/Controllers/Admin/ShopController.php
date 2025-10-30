<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shop::with(['seller', 'shopCategory'])->latest()->paginate(10);
        return view('admin.shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ShopCategory::all();
        $sellers = User::where('role', 'seller')->get();
        return view('admin.shops.create', compact('categories', 'sellers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'shop_category_id' => 'required|exists:shop_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('shops', 'public');
        }

        Shop::create($validated);

        return redirect()->route('admin.shops.index')
            ->with('success', __('messages.shop_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        $shop->load(['seller', 'shopCategory', 'products']);
        return view('admin.shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        $categories = ShopCategory::all();
        $sellers = User::where('role', 'seller')->get();
        return view('admin.shops.edit', compact('shop', 'categories', 'sellers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'shop_category_id' => 'required|exists:shop_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('shops', 'public');
        }

        $shop->update($validated);

        return redirect()->route('admin.shops.index')
            ->with('success', __('messages.shop_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();

        return redirect()->route('admin.shops.index')
            ->with('success', __('messages.shop_deleted'));
    }
}
