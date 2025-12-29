<x-layouts.app title="Edit Product">

<div class="container mt-4">
    <h3>Edit Product</h3>

    <form action="{{ route('products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ $product->name }}">
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number"
                   name="price"
                   class="form-control"
                   value="{{ $product->price }}">
        </div>

        <div class="mb-3">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('products.show', $product->id) }}"
           class="btn btn-secondary">Cancel</a>
    </form>
</div>

</x-layouts.app>
