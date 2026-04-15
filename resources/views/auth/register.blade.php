@extends('layouts.app')

@section('content')
<style>
    .auth-card {
        max-width: 420px;
        margin: 0 auto;
    }
    .auth-icon {
        font-size: 4rem;
        color: var(--maroon);
        margin-bottom: 1rem;
    }
    .auth-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-weight: 700;
        color: var(--black);
        margin-bottom: 1.5rem;
        font-size: 1.75rem;
    }
</style>

<div class="row justify-content-center mt-5">
    <div class="col-md-6 auth-card">
        <div class="card">
            <div class="card-body p-4">
                <div class="text-center">
                    <i class="ri-user-follow-line auth-icon"></i>
                    <h3 class="auth-title">Create Account</h3>
                </div>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="ri-user-line me-1"></i>Full Name
                        </label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter your name" required>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="ri-mail-line me-1"></i>Email
                        </label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email" required>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="ri-lock-line me-1"></i>Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Create a password" required>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            <i class="ri-lock-password-line me-1"></i>Confirm Password
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                        @error('password_confirmation')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="ri-user-add-line me-2"></i>Register
                        </button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <p class="text-muted">Already have an account?</p>
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                        <i class="ri-login-box-line me-1"></i>Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
