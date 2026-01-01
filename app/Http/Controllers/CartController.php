<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $sessionId = $request->session()->getId();

          $items = Cart::with('product')
        ->where('session_id', $sessionId)
        ->get();

        return view('cart.index', compact('items'));
    }

    public function add(Request $request, $id)
    {
        $sessionId = $request->session()->getId();

        $cart = Cart::where('session_id', $sessionId)
            ->where('product_id', $id)
            ->first();

        if ($cart) {
            $cart->increment('qty');
        } else {
            Cart::create([
                'session_id' => $sessionId,
                'product_id' => $id,
                'qty' => 1,
            ]);
        }

        return back()->with('success', 'Product added to cart');
    }

    public function remove(Request $request, $id)
{
    $sessionId = $request->session()->getId();

    Cart::where('id', $id)
        ->where('session_id', $sessionId)
        ->delete();

    return back()->with('success', 'Item removed');
}
}
