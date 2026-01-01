<x-layouts.app title="Products">

<div class="d-flex justify-content-between mb-4">
    <h3>Product List</h3>
    <a href="{{ route('products.create') }}" class="btn btn-success">
        + Add New Product
    </a>
</div>


<form method="GET" class="row mb-4">
    <div class="col-md-4">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               class="form-control"
               placeholder="Search title or description">
    </div>

    <div class="col-md-4">
        <select name="sort" class="form-control">
            <option value="">Sort</option>
            <option value="title_asc">Title A-Z</option>
            <option value="title_desc">Title Z-A</option>
            <option value="price_low">Price Low → High</option>
            <option value="price_high">Price High → Low</option>
        </select>
    </div>

    <div class="col-md-4">
        <button class="btn btn-primary w-100">Apply</button>
    </div>
</form>

<div class="row">
@foreach ($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top">
            <div class="card-body">
                <h5>{{ $product->name }}</h5>
                <p class="text-muted">Rp {{ number_format($product->price) }}</p>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary">
                    Detail
                </a>
            </div>
        </div>
    </div>
@endforeach
</div>

</x-layouts.app>
