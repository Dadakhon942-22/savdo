<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('seller');
    }

    public function index()
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        // Get all orders that contain products from this shop
        $orders = Order::whereHas('items.product', function($q) use ($shop) {
            $q->where('shop_id', $shop->id);
        })
        ->with(['user', 'items.product'])
        ->latest()
        ->paginate(15);

        // Add order total for each order (only shop products)
        foreach($orders as $order) {
            $orderTotal = OrderItem::where('order_id', $order->id)
                ->whereHas('product', function($q) use ($shop) {
                    $q->where('shop_id', $shop->id);
                })->sum('subtotal');
            $order->shop_total = $orderTotal;
        }

        // Calculate total sales
        $totalSales = OrderItem::whereHas('product', function($q) use ($shop) {
            $q->where('shop_id', $shop->id);
        })->sum('subtotal');

        // Get top selling products
        $topProducts = OrderItem::whereHas('product', function($q) use ($shop) {
            $q->where('shop_id', $shop->id);
        })
        ->selectRaw('product_id, SUM(quantity) as total_quantity, SUM(subtotal) as total_revenue')
        ->groupBy('product_id')
        ->orderByDesc('total_quantity')
        ->with('product')
        ->take(10)
        ->get();

        return view('seller.sales.index', compact('orders', 'shop', 'totalSales', 'topProducts'));
    }

    public function show(Order $order)
    {
        $user = auth()->user();
        $shop = $user->shops()->first();
        
        if (!$shop) {
            return redirect()->route('home')->with('error', __('messages.no_shop'));
        }

        // Verify that this order contains products from this shop
        $orderItems = $order->items()->whereHas('product', function($q) use ($shop) {
            $q->where('shop_id', $shop->id);
        })->get();

        if ($orderItems->isEmpty()) {
            return redirect()->route('seller.sales.index')->with('error', __('messages.order_not_found'));
        }

        // Filter order items to show only relevant products
        $order->setRelation('items', $orderItems);
        
        // Calculate shop total for this order
        $orderTotal = OrderItem::where('order_id', $order->id)
            ->whereHas('product', function($q) use ($shop) {
                $q->where('shop_id', $shop->id);
            })->sum('subtotal');
        $order->shop_total = $orderTotal;

        return view('seller.sales.show', compact('order', 'shop'));
    }
}
