<x-layouts.app title="Add Product">

<h3>Add New Product</h3>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control" required></textarea>
</div>

<div class="mb-3">
    <label>Price</label>
    <input type="number" name="price" class="form-control" required>
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control" required>
</div>

<button class="btn btn-success">Save</button>

</form>

</x-layouts.app>
