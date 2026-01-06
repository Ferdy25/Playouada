<x-layouts.app title="dashboard">

  <!--  {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Product List</h3>
        <a href="{{ route('products.create') }}" class="btn btn-success">
            + Add New Product
        </a>
    </div>

--> 
      {{-- ALERT ADD TO CART --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Search & Sort --}}
   <form method="GET" action="{{ route('products') }}" class="row mb-4">
        <div class="col-md-4 mb-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Search title or description">
        </div>

        <div class="col-md-4 mb-2">
            <select name="sort" class="form-control">
                <option value="">Sort</option>
                <option value="title_asc"  {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title A-Z</option>
                <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title Z-A</option>
                <option value="price_low"  {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price Low → High</option>
                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price High → Low</option>
            </select>
        </div>

        <div class="col-md-4 mb-2">
            <button class="btn btn-primary w-100">Apply</button>
        </div>
    </form>

    {{-- Product List --}}
    <div class="row">
            @forelse ($products as $product)
                <div class="col-6 col-md-4 col-lg-3 mb-3">
                    <div class="card shadow-sm h-100 p-1">

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            class="card-img-top"
                            style="height:150px; object-fit:cover;"
                            alt="{{ $product->name }}">

                        <div class="card-body d-flex flex-column p-2">
                            <h6 class="card-title mb-1">{{ $product->name }}</h6>

                            <p class="text-muted small mb-2">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('products.show', $product->id) }}"
                                class="btn btn-sm btn-outline-primary w-100 py-1 mb-1">
                                    Detail
                                </a>

                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary w-100 py-1">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @empty

            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Produk belum tersedia
                </div>
            </div>
        @endforelse
    </div>

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) alert.remove();
        }, 1000);
    </script>

</x-layouts.app>
