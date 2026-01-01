<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // 👉 HALAMAN CHECKOUT (GET)
    public function index(Request $request)
    {
        $sessionId = $request->session()->getId();

        $items = Cart::with('product')
            ->where('session_id', $sessionId)
            ->get();

        return view('checkout.index', compact('items'));
    }

    // 👉 PROSES CHECKOUT (POST)
    public function process(Request $request)
    {
        $sessionId = $request->session()->getId();

        $carts = Cart::with('product')
            ->where('session_id', $sessionId)
            ->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Cart empty');
        }

        $total = $carts->sum(function ($item) {
            return $item->product->price * $item->qty;
        });

        $order = Order::create([
            'session_id'  => $sessionId,
            'total_price' => $total,
        ]);

        foreach ($carts as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'qty'        => $item->qty,
                'price'      => $item->product->price,
            ]);
        }

        // kosongkan cart
        Cart::where('session_id', $sessionId)->delete();

        return redirect()->route('products')
            ->with('success', 'Checkout success');
    }
}
