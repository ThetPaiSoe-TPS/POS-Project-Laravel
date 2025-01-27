@extends('authentication.layouts.master')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-blue-500 to-indigo-600 py-6 flex flex-col justify-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card border-0 shadow-2xl rounded-lg overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row">
                            <!-- Left Column - Welcome Section -->
                            <div class="col-lg-5 d-none d-lg-block bg-dark text-white p-5">
                                <div class="h-100 d-flex flex-column justify-content-center">
                                    <h1 class="display-4 fw-bold mb-4">Welcome to Solstice Market</h1>
                                    <p class="lead opacity-75">Sign in to access your account and explore our marketplace.</p>
                                    <div class="mt-5">
                                        <img src="https://cdn.jsdelivr.net/npm/@tabler/icons@2.47.0/icons/shopping-cart.svg" alt="Login Illustration" class="img-fluid" style="width: 150px; margin: 0 auto;">
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Login Form -->
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center mb-5">
                                        <h2 class="h3 text-gray-900 mb-2">Sign In</h2>
                                        <p class="text-muted">Welcome back! Please enter your details</p>
                                    </div>

                                    <form class="user" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <!-- Email Input -->
                                        <div class="form-group mb-4">
                                            <label class="form-label small text-muted">Email Address</label>
                                            <input type="email" 
                                                class="form-control form-control-lg border-0 bg-light @error('email') is-invalid @enderror" 
                                                style="border-radius: 10px; padding: 1.2rem 1rem;"
                                                placeholder="name@example.com" 
                                                name="email" 
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password Input -->
                                        <div class="form-group mb-4">
                                            <label class="form-label small text-muted">Password</label>
                                            <input type="password" 
                                                class="form-control form-control-lg border-0 bg-light @error('password') is-invalid @enderror" 
                                                style="border-radius: 10px; padding: 1.2rem 1rem;"
                                                placeholder="Enter your password" 
                                                name="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Remember Me & Forgot Password -->
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck" style="border-radius: 4px;">
                                                <label class="form-check-label small" for="customCheck">Remember me</label>
                                            </div>
                                            <a href="forgot-password.html" class="small text-primary text-decoration-none">Forgot Password?</a>
                                        </div>

                                        <!-- Login Button -->
                                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-4" 
                                            style="border-radius: 10px; padding: 0.8rem">
                                            Sign In
                                        </button>

                                        <!-- Social Login Divider -->
                                        <div class="text-center mb-4">
                                            <span class="bg-white px-2 text-muted small">Or continue with</span>
                                        </div>

                                        <!-- Social Login Buttons -->
                                        <div class="d-grid gap-2 mb-4">
                                            <a href="{{ route('socialLogin', 'google') }}" 
                                                class="btn btn-outline-secondary btn-lg d-flex align-items-center justify-content-center gap-2"
                                                style="border-radius: 10px;">
                                                <i class="fab fa-google"></i>
                                                Sign in with Google
                                            </a>
                                            <a href="{{ route('socialLogin', 'github') }}" 
                                                class="btn btn-dark btn-lg d-flex align-items-center justify-content-center gap-2"
                                                style="border-radius: 10px;">
                                                <i class="fab fa-github"></i>
                                                Sign in with GitHub
                                            </a>
                                        </div>

                                        <!-- Register Link -->
                                        <div class="text-center">
                                            <span class="text-muted small">Don't have an account?</span>
                                            <a href="{{ route('register') }}" class="text-primary text-decoration-none ms-1">Create one</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Animation for the shopping bag icon */
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0px);
    }
}

.img-fluid {
    animation: float 3s ease-in-out infinite;
}

/* Custom Styles */
.card {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
    transition: transform 0.3s ease;
}

.form-control {
    transition: all 0.3s ease;
}

.form-control:focus {
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
    background-color: white !important;
}

.btn-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
    border: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(78, 115, 223, 0.25);
}

.btn-outline-secondary {
    border: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}

.btn-outline-secondary:hover {
    background-color: #f8fafc;
    transform: translateY(-1px);
}

.form-check-input:checked {
    background-color: #4e73df;
    border-color: #4e73df;
}

@media (max-width: 992px) {
    .card {
        margin: 1rem;
    }
}
</style>
@endsection
