@extends('layouts user.user')

@section('user-main-content')
<h1 class="h3 mb-4 text-gray-800">Daftar Order</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Order Anda</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th> <!-- Menambahkan kolom aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                    <tr>
                        <td>{{ $cart->produk->nama_produk }}</td> <!-- Menampilkan nama produk -->
                        <td>Rp {{ number_format($cart->produk->harga_produk, 0, ',', '.') }}</td> <!-- Menampilkan harga produk -->
                        <td>{{ $cart->jumlah }}</td> <!-- Menampilkan jumlah produk -->
                        <td>Rp {{ number_format($cart->produk->harga_produk * $cart->jumlah, 0, ',', '.') }}</td> <!-- Menghitung total harga -->
                        <td>{{ $cart->created_at->format('d-m-Y') }}</td>
                        <td>{{ $cart->status }}</td>
                        <td>
                            @if ($cart->status != 'canceled') <!-- Menampilkan tombol hanya jika status bukan canceled -->
                            <form action="{{ route('order.cancel', $cart->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Batalkan</button> <!-- Tombol pembatalan -->
                            </form>
                            @else
                            <span class="text-muted">Dibatalkan</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection