<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tri Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <img src="https://trijayamarket.my.id/wp-content/uploads/2024/06/WhatsApp_Image_2024-06-26_at_09.34.36-removebg-preview-1-150x150.png" class="attachment-thumbnail size-thumbnail wp-image-5537" alt="" width="48" height="50">
            <a class="navbar-brand" href="#">Tri Jaya</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-3">
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}" aria-current="page" href="{{route('welcome')}}">Home</a>
                    </li>
                    <!-- Shop -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{route('shop')}}">Shop</a>
                    </li>
                    <!-- About -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('abouts') ? 'active' : '' }}" href="{{route('abouts')}}">About</a>
                    </li>
                    <!-- Cart -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart') ? 'active' : '' }}" href="{{route('cart')}}">Cart</a>
                    </li>
                </ul>

                @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ url('/home') }}" class="btn btn-success mx-2">Admin Dashboard</a>
                    @elseif(Auth::user()->role === 'user')
                    <a href="{{ url('/user/home') }}" class="btn btn-success mx-2">User Dashboard</a>
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="btn btn-success mx-2">Login</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-success">Register</a>
                    @endif
                    @endauth
                </nav>
                @endif


            </div>
        </div>
    </nav>


    <div class="container">
        @yield('content')
    </div>

    <footer class="bg-primary text-white pt-4 mt-5">
        <div class="container">
            <div class="row">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="text-uppercase mb-3">Tri Jaya</h5>
                    <p>Sangat penting bagi pelanggan untuk memperhatikan proses adipiscing. Tetapi pada saat yang sama hal itu terjadi dengan susah payah dan kesakitan.</p>
                </div>
                <!-- Links -->
                <div class="col-lg-2 col-md-3 mb-4">
                    <h5 class="text-uppercase mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{route('home')}}" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="{{route('shop')}}" class="text-white text-decoration-none">Shop</a></li>
                        <li><a href="{{route('about')}}" class="text-white text-decoration-none">About</a></li>
                        <li><a href="{{route('cart')}}" class="text-white text-decoration-none">Cart</a></li>
                    </ul>
                </div>
                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-uppercase mb-3">Contact Us</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Jl. Yos Sudarso No.51, Bengkalis Kota, Kec. Bengkalis, Kabupaten Bengkalis, Riau 28712</p>
                    <p><i class="fas fa-envelope me-2"></i>julianjoe520@gmail.com</p>
                    <p><i class="fas fa-phone me-2"></i>0822-8755-4320</p>
                </div>
                <!-- Social Media -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-uppercase mb-3">Follow Us</h5>
                    <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <hr class="mb-4">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="mb-0">© 2024 Tri Jaya. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>


</body>

</html>