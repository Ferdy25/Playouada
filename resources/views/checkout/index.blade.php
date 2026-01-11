<x-layouts.app title="Checkout">

<div class="container mt-4">
    <h3>Checkout</h3>

    {{-- Kalau cart kosong --}}
    @if($cartItems->count() === 0)
        <div class="alert alert-warning">
            Keranjang kamu kosong
        </div>
    @else

    {{-- LIST PRODUK --}}
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>

            @php $total = 0; @endphp

            @foreach($cartItems as $item)
                @php
                    $subtotal = $item->qty * $item->product->price;
                    $total += $subtotal;
                @endphp

                <tr>
                    <td>
                        {{ $item->product->name }}

                        {{-- NOTE --}}
                        @if($item->note)
                            <br>
                            <small class="text-muted">
                                Note: {{ $item->note }}
                            </small>
                        @endif
                    </td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->product->price) }}</td>
                    <td>Rp {{ number_format($subtotal) }}</td>
                </tr>
            @endforeach

            <tr>
                <th colspan="3">Total</th>
                <th>Rp {{ number_format($total) }}</th>
            </tr>

        </tbody>
    </table>

    {{-- FORM CHECKOUT --}}
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        {{-- Alamat --}}
        <div class="mb-3">
            <label class="form-label">Alamat Pengiriman</label>
            <textarea
                name="shipping_address"
                class="form-control"
                rows="3"
                required></textarea>
        </div>

        {{-- Payment --}}
        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="payment_method" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="cod">COD</option>
                <option value="transfer">Transfer Bank</option>
                <option value="ewallet">E-Wallet</option>
            </select>
        </div>

        <button class="btn btn-success w-100">
            Proses Checkout
        </button>
    </form>

    @endif
</div>

</x-layouts.app>
