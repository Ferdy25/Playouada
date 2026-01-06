<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // LIST PRODUCT
         public function index(Request $request)
    {
        // Query dasar (BELUM dieksekusi)
        $query = Product::query();

        /**
         * ======================
         * SEARCH
         * ======================
         * Jika ada parameter ?search=
         */
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        /**
         * ======================
         * SORT
         * ======================
         * Berdasarkan dropdown
         */
        switch ($request->sort) {
            case 'title_asc':
                $query->orderBy('name', 'asc');
                break;

            case 'title_desc':
                $query->orderBy('name', 'desc');
                break;

            case 'price_low':
                $query->orderBy('price', 'asc');
                break;

            case 'price_high':
                $query->orderBy('price', 'desc');
                break;

            default:
                // Default sorting
                $query->latest();
        }

        // Eksekusi query
        $products = $query->get();

        return view('dashboard', compact('products'));
    }
    
    // FORM CREATE
    public function create()
    {
        return view('products.form');
    }

    // STORE PRODUCT
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image'
        ]);

        $image = $request->file('image')->store('products', 'public');

        Product::create([
            'name'  => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $image,
        ]);

        return redirect()->route('dashboard')->with('success', 'Product added');
    }

    // SHOW PRODUCT (INI SUDAH BENER)
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // 👉 EDIT PRODUCT (INI YANG HILANG TADI)
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('products', 'public');
            $product->image = $image;
        }

        $product->update([
            'name'  => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('products.show', $product->id)
                         ->with('success', 'Product updated');
    }
}
