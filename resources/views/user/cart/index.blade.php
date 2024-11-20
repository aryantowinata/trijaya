@extends('layouts user.user')

@section('user-main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Keranjang Belanja') }}</h1>

@if($carts->isEmpty())
<p>Keranjang Anda kosong.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($carts as $cart)
        <tr>
            <td>{{ $cart->produk->nama_produk }}</td>
            <td>{{ $cart->jumlah }}</td>
            <td>Rp{{ number_format($cart->produk->harga_produk, 2, ',', '.') }}</td>
            <td>Rp{{ number_format($cart->produk->harga_produk * $cart->jumlah, 2, ',', '.') }}</td>
            <td>
                <form action="{{ route('user.cart.remove', $cart->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form action="{{ route('user.checkout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success">Checkout</button>
</form>
@endif


@endsection