@extends('layouts user.user')

@section('user-main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Daftar Pesanan') }}</h1>

@if($orders->isEmpty())
<p>Tidak ada pesanan yang ditemukan.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>ID Pesanan</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>Rp{{ number_format($order->total_harga, 2, ',', '.') }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->created_at->format('d-m-Y') }}</td>
            <td>
                <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection