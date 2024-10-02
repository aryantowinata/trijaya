@extends('layouts.landing')

@section('content')
<div class="container mt-5 pt-3">
    <h2 class="text-center mt-5 mb-4 text-primary">Shop</h2>
</div>
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar Kategori -->
        <div class="col-md-3">
            <!-- Kategori Produk -->
            <div class="mb-4">
                <h5 class="mb-3">Categories</h5>
                <ul class="list-group">
                    @foreach($kategories as $kategori)
                    <li class="list-group-item d-flex align-items-center">
                        <i class="bi bi-bag-fill me-2"></i> <!-- Ikon Bootstrap -->
                        <a class="text-decoration-none text-black" href="{{ route('shop.category', $kategori->id) }}">{{ $kategori->nama_kategori }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>





            <!-- Product Tags -->
            <div class="mb-4">
                <h5 class="mb-3">Product Tags</h5>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-primary">Premium</span>
                    <span class="badge bg-success">Promo</span>
                    <span class="badge bg-warning text-dark">Diskon</span>
                </div>
            </div>
        </div>

        <!-- Produk -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>Showing {{ count($produks) }} results</div>
                <form method="GET" action="{{ route('shop') }}">
                    <select class="form-select w-auto" name="sort" onchange="this.form.submit()">
                        <option value="">Default sorting</option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Sort by price (low to high)</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Sort by price (high to low)</option>
                    </select>
                </form>
            </div>



            @if($produks->isEmpty())
            <div class="alert alert-warning text-center">Tidak ada produk dalam kategori ini.</div>
            @else
            <div class="row">
                @foreach($produks as $product)
                <div class="col-md-4 mb-4">
                    <div class="card text-center h-100">
                        <img src="{{ asset('storage/produk/' . $product->gambar_produk) }}" class="card-img-top" alt="{{ $product->nama_produk }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->nama_produk }}</h5>
                            <p class="card-text">Rp{{ number_format($product->harga_produk, 2, ',', '.') }}</p>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-danger btn-sm">Add to cart</button>
                                    <a class="btn btn-success btn-sm" href="https://api.whatsapp.com/send?phone=6282287554320&amp;text=Halo,%20saya%20ingin%20bertanya%20tentang%20produk" role="button" target="_blank">Buy via WA</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif


        </div>
    </div>
</div>
@endsection