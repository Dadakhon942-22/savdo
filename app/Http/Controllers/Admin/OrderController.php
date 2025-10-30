<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        $query = Order::with('user', 'items.product');
        
        // Savdogar faqat o'z mahsulotlariga tegishli buyurtmalarni ko'radi
        if ($user->isSeller()) {
            $query->whereHas('items.product', function($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }
        // Admin barchasini ko'radi
        
        $orders = $query->latest()->get();
            
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated');
    }
}
