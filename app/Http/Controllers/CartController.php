<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();
            
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        if ($product->stock < $request->quantity) {
            return back()->with('error', __('messages.not_enough_stock'));
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($product->stock < $newQuantity) {
                return back()->with('error', __('messages.not_enough_stock'));
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', __('messages.product_added'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        if ($cartItem->product->stock < $request->quantity) {
            return back()->with('error', __('messages.not_enough_stock'));
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', __('messages.cart_updated'));
    }

    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', __('messages.item_removed'));
    }
}
