@extends('layouts user.user')

@section('user-main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
<div class="alert alert-success border-left-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{route('history_order.index')}}" class="text-decoration-none">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h1  font-weight-bold text-secondary text-uppercase mb-1">{{ __('User') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>

                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{route('user.orders')}}" class="text-decoration-none">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('Orders') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cart-shopping fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>


    <!-- Total Produk Card Example -->



</div>

@endsection