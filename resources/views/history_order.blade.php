@extends('layouts.admin')

@section('main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Order History') }} <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Tambah</a></h1>

<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table id="products-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal Pembelian</th>
                <th>Jenis Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->user ? $order->user->name : 'Tidak ada user' }}</td>
                <td>Rp.{{ number_format($order->total_harga, 2, ',', '.') }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#">Detail</a>
                    <form action="3" method="POST" class="d-inline-block delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm delete-button">Delete</button>
                    </form>
                </td>





            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection