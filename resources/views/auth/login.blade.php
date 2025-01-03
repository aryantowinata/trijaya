@extends('layouts.auth')

@section('main-content')
<!-- Login Form -->
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg" style="width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Login</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
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
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="mt-3 text-center">
                <p>Don't have an account? <a href="{{ route('register') }}">Register Here</a></p>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

@endsection