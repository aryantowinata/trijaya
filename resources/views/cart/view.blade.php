@extends('layouts user.user')

@section('user-main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Keranjang Belanja') }}</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($carts->isEmpty())
<p>Keranjang Anda kosong.</p>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach($carts as $cart)
        @php $subtotal = $cart->produk->harga_produk * $cart->jumlah; @endphp
        <tr>
            <td>{{ $cart->produk->nama_produk }}</td>
            <td>
                <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="number" name="jumlah" value="{{ $cart->jumlah }}" min="1" onchange="this.form.submit()">
                </form>
            </td>
            <td>Rp{{ number_format($cart->produk->harga_produk, 2, ',', '.') }}</td>
            <td>Rp{{ number_format($subtotal, 2, ',', '.') }}</td>
            <td>
                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @php $total += $subtotal; @endphp
        @endforeach
    </tbody>
</table>

<h4>Total: Rp{{ number_format($total, 2, ',', '.') }}</h4>

@endif

@endsection