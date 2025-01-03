@extends('layouts.admin')

@section('main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Detail Order') }}</h1>

<div class="container">
    <h3>Informasi Order</h3>
    <table class="table table-bordered">
        <tr>
            <th>Nama Pembeli</th>
            <td>{{ $order->user->name ?? 'Tidak ada user' }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp. {{ number_format($order->total_harga, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $order->status }}</td>
        </tr>
        <tr>
            <th>Tanggal Pembelian</th>
            <td>{{ $order->created_at }}</td>
        </tr>
        <tr>
            <th>Jenis Pembayaran</th>
            <td>{{ $order->payment_va_name }}</td>
        </tr>
        <tr>
            <th>No Rekening</th>
            <td>{{ $order->payment_va_number }}</td>
        </tr>
    </table>

    <h3>Produk dalam Order</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Gambar Produk</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>
                    @if($item->produk && $item->produk->gambar)
                    <img src="{{ asset('storage/' . $item->produk->gambar) }}" alt="{{ $item->produk->nama_produk }}" style="width: 100px; height: auto;">
                    @else
                    <span>Tidak ada gambar</span>
                    @endif
                </td>
                <td>{{ $item->produk->nama_produk ?? 'Produk tidak ditemukan' }}</td>
                <td>Rp. {{ number_format($item->harga_satuan, 2, ',', '.') }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp. {{ number_format($item->harga_satuan * $item->jumlah, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('history_order.index') }}" class="btn btn-primary mt-3">Kembali</a>
</div>
@endsection