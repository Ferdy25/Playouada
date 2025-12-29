<x-layouts.app title="Products">

<div class="d-flex justify-content-between mb-4">
    <h3>Product List</h3>
    <a href="{{ route('products.create') }}" class="btn btn-success">
        + Add New Product
    </a>
</div>

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
