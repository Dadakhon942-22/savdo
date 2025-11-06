<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin barcha statistikani ko'radi
            $stats = [
                'total_orders' => Order::count(),
                'pending_orders' => Order::where('status', 'pending')->count(),
                'total_products' => Product::count(),
                'total_users' => User::count(),
                'total_shops' => Shop::count(),
                'total_shop_categories' => ShopCategory::count(),
                'total_categories' => Category::count(),
            ];

            $recentOrders = Order::with('user', 'items')
                ->latest()
                ->take(5)
                ->get();
        } else {
            // Savdogar faqat o'z statistikasini ko'radi
            $stats = [
                'total_orders' => Order::whereHas('items.product', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->count(),
                'pending_orders' => Order::where('status', 'pending')
                    ->whereHas('items.product', function($q) use ($user) {
                        $q->where('user_id', $user->id);
                    })->count(),
                'total_products' => Product::where('user_id', $user->id)->count(),
                'total_users' => 0,
                'total_shops' => 0,
                'total_shop_categories' => 0,
                'total_categories' => 0,
            ];

            $recentOrders = Order::whereHas('items.product', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
                ->with('user', 'items')
                ->latest()
                ->take(5)
                ->get();
        }

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
