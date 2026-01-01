<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // LIST PRODUCT
       public function index(Request $request)
    {
        // mulai query
        $query = Product::query();

        // 🔍 FILTER SEARCH (name & description)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // 🔃 SORTING
        if ($request->sort == 'title_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($request->sort == 'title_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($request->sort == 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_high') {
            $query->orderBy('price', 'desc');
        } else {
            // default
            $query->latest();
        }

        $products = $query->get();

        return view('products.list', compact('products'));
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

        return redirect()->route('products')->with('success', 'Product added');
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
