@extends('layouts.auth')

@section('content')
<div class="container-tight py-6">
    <div class="text-center mb-4">
        <img src="./static/logo.svg" height="36" alt="">
    </div>
    <form class="card card-md" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="card-body">
            <h2 class="mb-5 text-center">Login to your account</h2>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"/>
                    <span class="form-check-label">Remember me on this device</span>
                </label>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </div>
        </div>
    </form>
    <div class="text-center text-muted">
        Don't have account yet? <a href="{{ route('register') }}" tabindex="-1">Sign up</a>
    </div>
</div>
@endsection
