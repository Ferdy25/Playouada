<x-layouts.app title="Home">

<div class="text-center">
    <h1 class="fw-bold display-4">Welcome to Play 🛍️</h1>
    <p class="lead text-muted">
        Tempat terbaik untuk mengelola produk kamu dengan tampilan modern
    </p>

    <a href="{{ route('products') }}" class="btn btn-primary btn-lg mt-3">
        Lihat Produk
    </a>
</div>

<div class="row mt-5 text-center">
    <div class="col-md-4">
        <h4>🚀 Cepat</h4>
        <p>Laravel + Herd</p>
    </div>
    <div class="col-md-4">
        <h4>🎨 Modern</h4>
        <p>Bootstrap 5 UI</p>
    </div>
    <div class="col-md-4">
        <h4>🔒 Aman</h4>
        <p>Validasi lengkap</p>
    </div>
</div>

</x-layouts.app>
