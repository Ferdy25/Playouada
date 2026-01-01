<x-layouts.app>
    <div class="container mt-4">
        <h3>Checkout</h3>

        @if($items->count() > 0)

            <table class="table">
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

                    @foreach($items as $item)
                        @php
                            $subtotal = $item->qty * $item->product->price;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->product->price,0,',','.') }}</td>
                            <td>Rp {{ number_format($subtotal,0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>Total: Rp {{ number_format($total,0,',','.') }}</h4>

              <form action="{{ route('checkout.process') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-primary mt-3">
                    Proses Pesanan
                </button>
            </form>
        @else
            <div class="alert alert-warning">
                Tidak ada item untuk checkout
            </div>
        @endif
    </div>
</x-layouts.app>
