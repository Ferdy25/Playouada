{{-- Pakai layout utama --}}
<x-layouts.app title="Product Detail">

{{-- Judul halaman --}}
@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-6">
        {{-- Gambar produk --}}
        <div class="card shadow-sm">
            <img 
                src="{{ asset('storage/' . $product->image) }}" 
                class="card-img-top"
                alt="{{ $product->name }}"
            >
        </div>
    </div>

    <div class="col-md-6">
        {{-- Informasi produk --}}
        <h2 class="mb-3">{{ $product->name }}</h2>

        <h4 class="text-success mb-3">
            Rp {{ number_format($product->price) }}
        </h4>

        <p class="text-muted">
            {{ $product->description }}
        </p>

        <div class="mt-4">
            {{-- Tombol kembali --}}
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                ← Back to Products
            </a>

            {{-- Tombol edit --}}
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                Edit Product
            </a>
            
        </div>
    </div>
</div>


</x-layouts.app>
