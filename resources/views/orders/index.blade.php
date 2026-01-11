<h3>Riwayat Pesanan</h3>

@foreach ($orders as $order)
<h5>Order #{{ $order->id }}</h5>
<p>Status: {{ $order->status }}</p>
<p>Total: Rp {{ number_format($order->total_price) }}</p>

<ul>
@foreach ($order->items as $item)
<li>
{{ $item->product->name }} x {{ $item->qty }}
<br>Note: {{ $item->note }}
</li>
@endforeach
</ul>
<hr>
@endforeach
