@extends('layouts user.user')

@section('user-main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Daftar Produk') }}</h1>

<div class="row">
    @foreach($produks as $produk)
    <div class="col-md-4 col-12 mb-4">
        <div class="card h-100">
            <div class="row no-gutters d-flex align-items-stretch">
                <div class="col-md-4">
                    <img src="{{ asset('storage/produk/' . $produk->gambar_produk) }}" class="img-fluid img-thumbnail" alt="{{ $produk->nama_produk }}" style="max-width: 100px;">
                </div>

                <div class="col-md-8 d-flex flex-column">
                    <div class="card-body flex-grow-1">
                        <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                        <p class="card-text">Rp{{ number_format($produk->harga_produk, 2, ',', '.') }}</p>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('user.cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_produk" value="{{ $produk->id }}">
                            <div class="form-group mb-2">
                                <label for="jumlah_{{ $produk->id }}">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah_{{ $produk->id }}" value="1" min="1">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Beli</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection