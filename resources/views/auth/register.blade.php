@extends('layouts.auth')

@section('content')
<div class="container-tight py-6">
    <div class="text-center mb-4">
        <img src="./static/logo.svg" height="36" alt="">
    </div>
    <form class="card card-md" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="card-body">
            <h2 class="mb-5 text-center">Create new account</h2>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">Create new account</button>
            </div>
        </div>
    </form>
    <div class="text-center text-muted">
        Already have account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
    </div>
</div>
@endsection
