@extends('layouts user.user')

@section('user-main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Detail Pesanan') }}</h1>

<p><strong>ID Pesanan:</strong> {{ $order->id }}</p>
<p><strong>Total Harga:</strong> Rp{{ number_format($order->total_harga, 2, ',', '.') }}</p>
<p><strong>Status:</strong> {{ $order->status }}</p>
<p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d-m-Y') }}</p>

<h4>Detail Item Pesanan</h4>
<table class="table">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $item->produk->nama_produk }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>Rp{{ number_format($item->harga_satuan, 2, ',', '.') }}</td>
            <td>Rp{{ number_format($item->harga_satuan * $item->jumlah, 2, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('user.orders') }}" class="btn btn-primary">Kembali ke Daftar Pesanan</a>
@endsection