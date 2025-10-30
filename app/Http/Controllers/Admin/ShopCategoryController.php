<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShopCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ShopCategory::withCount('shops')->latest()->paginate(10);
        return view('admin.shop-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shop-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('shop-categories', 'public');
        }

        ShopCategory::create($validated);

        return redirect()->route('admin.shop-categories.index')
            ->with('success', __('messages.shop_category_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ShopCategory $shopCategory)
    {
        $shopCategory->load('shops');
        return view('admin.shop-categories.show', compact('shopCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShopCategory $shopCategory)
    {
        return view('admin.shop-categories.edit', compact('shopCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShopCategory $shopCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('shop-categories', 'public');
        }

        $shopCategory->update($validated);

        return redirect()->route('admin.shop-categories.index')
            ->with('success', __('messages.shop_category_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopCategory $shopCategory)
    {
        $shopCategory->delete();

        return redirect()->route('admin.shop-categories.index')
            ->with('success', __('messages.shop_category_deleted'));
    }
}
