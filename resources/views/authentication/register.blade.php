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
                                    <h1 class="display-4 fw-bold mb-4">Join Solstice Market</h1>
                                    <p class="lead opacity-75">Create an account to start your shopping journey with us.</p>
                                    <div class="mt-5 text-center">
                                        <img src="https://cdn.jsdelivr.net/npm/@tabler/icons@2.47.0/icons/user-plus.svg" 
                                             alt="Register Illustration" 
                                             class="img-fluid register-icon" 
                                             style="width: 150px; filter: invert(1);">
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Register Form -->
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <h2 class="h3 text-gray-900 mb-2">Create an Account</h2>
                                        <p class="text-muted">Fill in your information to get started</p>
                                    </div>

                                    <form class="user" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <!-- Name and Phone -->
                                        <div class="row mb-4">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label small text-muted">Full Name</label>
                                                    <input type="text" 
                                                           class="form-control form-control-lg border-0 bg-light @error('name') is-invalid @enderror" 
                                                           style="border-radius: 10px; padding: 1rem"
                                                           placeholder="John Doe" 
                                                           name="name" 
                                                           value="{{ old('name') }}">
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label small text-muted">Phone Number</label>
                                                    <input type="tel" 
                                                           class="form-control form-control-lg border-0 bg-light @error('phone') is-invalid @enderror" 
                                                           style="border-radius: 10px; padding: 1rem"
                                                           placeholder="+1 (234) 567-8900" 
                                                           name="phone" 
                                                           value="{{ old('phone') }}">
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group mb-4">
                                            <label class="form-label small text-muted">Email Address</label>
                                            <input type="email" 
                                                   class="form-control form-control-lg border-0 bg-light @error('email') is-invalid @enderror" 
                                                   style="border-radius: 10px; padding: 1rem"
                                                   placeholder="name@example.com" 
                                                   name="email" 
                                                   value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password and Confirmation -->
                                        <div class="row mb-4">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label small text-muted">Password</label>
                                                    <input type="password" 
                                                           class="form-control form-control-lg border-0 bg-light @error('password') is-invalid @enderror" 
                                                           style="border-radius: 10px; padding: 1rem"
                                                           placeholder="••••••••" 
                                                           name="password">
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label small text-muted">Confirm Password</label>
                                                    <input type="password" 
                                                           class="form-control form-control-lg border-0 bg-light" 
                                                           style="border-radius: 10px; padding: 1rem"
                                                           placeholder="••••••••" 
                                                           name="password_confirmation">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Register Button -->
                                        <button type="submit" 
                                                class="btn btn-primary btn-lg w-100 mb-4" 
                                                style="border-radius: 10px; padding: 0.8rem">
                                            Create Account
                                        </button>

                                        <!-- Login Link -->
                                        <div class="text-center mt-4">
                                            <span class="text-muted small">Already have an account?</span>
                                            <a href="{{ route('login') }}" class="text-primary text-decoration-none ms-1">Sign in</a>
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
/* Animation for the register icon */
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

.register-icon {
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

@media (max-width: 992px) {
    .card {
        margin: 1rem;
    }
}
</style>
@endsection
