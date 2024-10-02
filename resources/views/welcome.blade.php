@extends('layouts.landing')
@section('content')

<div class="jumbotron mt-5 pt-3" style="background-image: url('/asset/img/shopping.jpg'); background-size: cover; background-position: center; padding: 50px 0;">
    <div class="container mt-5 pt-3 mx-5" style="max-width: 600px; text-align: left; margin-left: 0;">
        <h1 class="display-4" style="color: #2e87d2; font-weight: bold;">Selamat Datang ke Minimarket TRIJaya</h1>
        <p class="lead mt-3" style="color: #000;">Banyak Produk yang lagi promosi, Ayok belanja sekarang!!!</p>
        <a href="#shop" class="btn btn-primary btn-lg mt-5" style="background-color: #2e87d2; border: none; align-self:center">
            Belanja Sekarang <i class="bi bi-cart"></i>
        </a>
    </div>
</div>




<div class="container mt-5">
    <div class="row text-center">
        <div class="col-lg-4 d-flex align-items-center">
            <img src="{{('../asset/img/done.png')}}" alt="Gratis Kirim Icon" class="img-fluid me-3" style="width: 80px; height: 80px;">
            <div class="text-start">
                <h4>Gratis Kirim</h4>
                <p>Minimal pembelian 400Ribu</p>
            </div>
        </div>
        <div class="col-lg-4 d-flex align-items-center">
            <img src="{{('../asset/img/Quick.png')}}" alt="Quick Paymeny Icon" class="img-fluid me-3" style="width: 80px; height: 80px;">
            <div class="text-start">
                <h4>Quick paymeny</h4>
                <p>Proses pembayaran cepat dan aman</p>
            </div>
        </div>
        <div class="col-lg-4 d-flex align-items-center">
            <img src="{{('../asset/img/Return.jpg')}}" alt="Gratis Return Icon" class="img-fluid me-3" style="width: 80px; height: 80px;">
            <div class="text-start">
                <h4>Gratis Return</h4>
                <p>Syarat &Kententuan Berlaku</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-5">
    <h2 class="text-center text-primary">KATEGORI PRODUK</h2>
</div>
<div class="container mt-5">
    <div class="row g-4">
        @foreach($kategories as $kategori)
        <div class="col-lg-4">
            <div class="card d-flex flex-column h-100">
                <img src="{{ asset('storage/kategori/' . $kategori->gambar_kategori) }}" class="card-img-top" alt="{{ $kategori->nama_kategori }}">
                <div class="card-body d-flex flex-column">
                    <p class="card-text fw-bold text-center" style="margin: 0;">{{ $kategori->nama_kategori }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="mt-5">
    <h2 class="text-center text-primary">PRODUK TERSEDIA</h2>
</div>
<div class="container mt-5">
    <div class="row g-4">
        @foreach($produks as $product)
        <div class="col-lg-4">
            <div class="card h-100">
                <img src="{{ asset('storage/produk/' . $product->gambar_produk) }}" class="card-img-top" alt="{{ $product->nama_produk }}">
                <div class="card-body d-flex flex-column">
                    <p class="card-text fw-bold text-center" style="margin: 0;">{{ $product->nama_produk }}</p>
                </div>
                <div class="card-footer text-center">
                    <p class="card-text fw-bold" style="margin: 0;">Rp. {{ number_format($product->harga_produk, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection