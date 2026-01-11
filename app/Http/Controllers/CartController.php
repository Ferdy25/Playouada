<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Tampilkan cart milik user login
     */
    public function index()
    {
        // Ambil cart berdasarkan user login, bukan session
        $items = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('cart.index', compact('items'));
    }

    /**
     * Tambah produk ke cart
     */
    public function add($productId)
    {
        // Cek apakah produk sudah ada di cart user
        $item = CartItem::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($item) {
            // Jika sudah ada → tambah qty
            $item->increment('qty');
        } else {
            // Jika belum → buat baru
            CartItem::create([
                'user_id'    => auth()->id(),
                'product_id' => $productId,
                'qty'        => 1
            ]);
        }

        return back()->with('success', 'Produk masuk keranjang');
    }

    /**
     * Tambah qty (+)
     */
    public function increase(CartItem $cartItem)
    {
        $this->authorizeCart($cartItem); // ⬅️ pengaman

        $cartItem->increment('qty');
        return back();
    }

    /**
     * Kurangi qty (-) — tidak boleh < 1
     */
    public function decrease(CartItem $cartItem)
    {
        $this->authorizeCart($cartItem);

        if ($cartItem->qty > 1) {
            $cartItem->decrement('qty');
        }

        return back();
    }

    /**
     * Update note per item
     */
    public function updateNote(Request $request, CartItem $cartItem)
    {
        $this->authorizeCart($cartItem);

        $cartItem->update([
            'note' => $request->note
        ]);

        return back();
    }

    /**
     * Hapus item dari cart
     */
    public function remove(CartItem $cartItem)
    {
        $this->authorizeCart($cartItem);

        $cartItem->delete();
        return back()->with('success', 'Item dihapus');
    }

    /**
     * Pastikan cart milik user yg login
     */
    private function authorizeCart(CartItem $cartItem)
    {
        abort_if($cartItem->user_id !== auth()->id(), 403);
    }
}
