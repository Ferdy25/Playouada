<x-layouts.app>
    <div class="container mt-4">
        <h3>Keranjang</h3>

        {{-- CEK APAKAH CART KOSONG --}}
        @if($items->count() > 0)

            @foreach($items as $item)
                <div class="d-flex justify-content-between align-items-center border p-2 mb-2">
                    <div>
                        <strong>{{ $item->product->name }}</strong><br>
                        Qty: {{ $item->qty }} <br>
                        Harga: Rp {{ number_format($item->product->price, 0, ',', '.') }}
                    </div>

                  <form action="{{ route('cart.decrease', $item->id) }}" method="POST">
                        @csrf
                        <button>-</button>
                    </form>

                    <span>{{ $item->qty }}</span>

                    <form action="{{ route('cart.increase', $item->id) }}" method="POST">
                        @csrf
                        <button>+</button>
                    </form>

                    <form action="{{ route('cart.note', $item->id) }}" method="POST">
                        @csrf
                        <input type="text" name="note" value="{{ $item->note }}">
                        <button>Simpan Note</button>
                    </form>


                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>

                </div>
            @endforeach

            <a href="{{ route('checkout') }}" class="btn btn-success mt-3">
                Checkout
            </a>

        @else
            <div class="alert alert-warning mt-3">
                Keranjang masih kosong
            </div>
        @endif
          {{-- Tombol kembali --}}
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                ← Back 
            </a>
    </div>
</x-layouts.app>
