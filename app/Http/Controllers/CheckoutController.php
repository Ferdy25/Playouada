<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout
     */
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('checkout.index', compact('cartItems'));
    }

    /**
     * Proses checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'payment_method'   => 'required|string',
        ]);

        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang kosong');
        }

        // hitung total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->qty;
        }

        // simpan order
        $order = Order::create([
            'user_id'          => auth()->id(),
            'total_price'      => $total,
            'address' => $request->shipping_address,
            'payment_method'   => $request->payment_method,
            'status'           => 'pending',
        ]);

        // simpan item order
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'  => $order->id,
                'product_id'=> $item->product_id,
                'qty'       => $item->qty,
                'price'     => $item->product->price,
                'note'      => $item->note,
            ]);
        }

        // hapus cart setelah checkout
        CartItem::where('user_id', auth()->id())->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Checkout berhasil');
    }
}
