@extends('layouts.landing')
@section('content')
<div class="container mt-5 pt-3">
    <h2 class="text-center mt-5 mb-4">About Us</h2>

    <div class="row">
        <div class="col-md-6">
            <h3>Selamat Datang ke Minimarket TRI JAYA</h3>
            <p style="text-align: justify;">
                Tri Jaya adalah pengecer online terkemuka, berkomitmen untuk menawarkan produk dan layanan berkualitas tinggi kepada pelanggan kami yang berharga. Sejak awal, kami berfokus untuk memberikan pengalaman berbelanja yang luar biasa dengan beragam produk, harga kompetitif, dan pengiriman cepat.
            </p>
            <p style="text-align: justify;">
                Tim kami berdedikasi untuk memastikan bahwa setiap pelanggan menemukan apa yang mereka cari. Baik Anda berbelanja barang elektronik, fashion, atau perlengkapan rumah tangga, Tri Jaya adalah toko serba ada.
            </p>
        </div>
        <div class="col-md-6">
            <img src="{{('../asset/img/Tri.jpeg')}}" alt="Our Team" class="img-fluid rounded-3">
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-md-6">
            <img src="{{('../asset/img/Dalam.jpeg')}}" alt="Our Mission" class="img-fluid rounded-3">
        </div>
        <div class="col-md-6">
            <h3>Selamat belanja di Toko TRI JAYA</h3>
            <p style="text-align: justify;">
                Toko Tri Jaya adalah toko ritel modern yang berlokasi di Bengkalis, Didirikan pada tahun 1988.

                Tri Jaya telah menjadi bagian integral dari kehidupan sehari-hari warga Bengkalis selama lebih dari satu dekade. Nama ‘Tri Jaya’ mencerminkan tiga pilar utama filosofi bisnis kami: kualitas produk, layanan pelanggan, dan kontribusi masyarakat. Kami berkomitmen untuk menyediakan berbagai produk kebutuhan sehari-hari dengan kualitas terbaik dan harga yang terjangkau.
            </p>
            <p style="text-align: justify;">
                Berbeda dengan minimarket pada umumnya, Tri Jaya memiliki ciri khas tersendiri. Kami menggabungkan konsep toko modern dengan sentuhan lokal, menciptakan suasana belanja yang nyaman namun tetap akrab.Tri Jaya juga dikenal dengan layanan pelanggan yang ramah dan personal. Karyawan kami dilatih untuk memberikan senyuman dan sapaan hangat kepada setiap pelanggan, serta siap membantu dengan berbagai pertanyaan atau kebutuhan khusus.
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h3 class="text-center">Nilai-Nilai: </h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Pelanggan Pertama: Kami mengutamakan kebutuhan dan kepuasan pelanggan kami.</li>
                <li class="list-group-item">Inovasi: Kami terus berinovasi untuk memberikan layanan dan produk yang lebih baik.</li>
                <li class="list-group-item">Integritas: Kami menjaga standar etika yang tinggi dalam semua operasi kami.</li>
                <li class="list-group-item">Keberlanjutan: Kami berkomitmen terhadap praktik bisnis yang bertanggung jawab dan berkelanjutan.</li>
            </ul>
        </div>
    </div>
</div>

@endsection