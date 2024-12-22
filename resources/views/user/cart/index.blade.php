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

{{-- Tampilkan Detail Order --}}
<div class="mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Order</h5>
        </div>
        <div class="card-body">
            <p>
                <span class="badge bg-info text-dark me-2">Jumlah Order</span>
                <strong>{{ $jumlahOrder }}</strong>
            </p>
            <p>
                <span class="badge bg-success text-white me-2">Jenis Produk</span>
                <strong>{{ implode(', ', $jenisProduk) }}</strong>
            </p>
            <p>
                <span class="badge bg-warning text-dark me-2">Total Harga</span>
                <strong>Rp{{ number_format($totalHarga, 2, ',', '.') }}</strong>
            </p>
        </div>
    </div>
</div>

{{-- Tombol Checkout --}}
<form action="{{ route('user.checkout') }}" method="POST" class="mt-3">
    @csrf
    <button type="submit" class="btn btn-success btn-lg w-100">Checkout</button>
</form>
@endif
@endsection