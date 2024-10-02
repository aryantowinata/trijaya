@extends('layouts.landing')
@section('content')
<div class="container mt-5 pt-3">
    <h2 class="text-center mt-5 mb-4">Your Cart</h2>

    <div class="table-responsive">
        <table class="table table-bordered cart-table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Cart Item -->
                <tr>
                    <td><img src="https://via.placeholder.com/100" alt="Product Image" class="img-fluid"></td>
                    <td>Product Name</td>
                    <td>RP50.000</td>
                    <td>
                        <input type="number" class="form-control" value="1" min="1">
                    </td>
                    <td>RP50.000</td>
                    <td>
                        <button class="btn btn-danger btn-sm">Remove</button>
                    </td>
                </tr>
                <!-- Repeat for other items -->
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <div class="total-amount">
            <h4>Total: Rp50.000</h4>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{route('shop')}}" class="btn btn-secondary">Continue Shopping</a>
        <a href="#" class="btn btn-primary">Proceed to Checkout</a>
    </div>
</div>


@endsection