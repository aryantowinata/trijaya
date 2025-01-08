@extends('layouts.auth')

@section('main-content')
<!-- Register Form -->
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg" style="width: 400px;">
        <div class="card-body">

            <h3 class="card-title text-center mb-4">Register</h3>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter your name">
                    @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="Enter your last name">
                    @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                    @error('email')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                    @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
                </div>
                <button type="submit" class="btn btn-success w-100">Register</button>
            </form>
            <div class="mt-3 text-center">
                <p>Already have an account? <a href="{{ route('login') }}">Login Here</a></p>
            </div>
        </div>
    </div>
</div>

@endsection