<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Play</a>

        <div>
             <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm">
                Home
            </a>
            <a href="{{ route('products') }}" class="btn btn-outline-light btn-sm">
                Products
            </a>
             <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm">
                Keranjang
            </a>
        </div>
    </div>
</nav>
