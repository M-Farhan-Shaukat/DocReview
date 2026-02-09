@extends('layouts.user')

@section('title', 'Sign Up')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Registration Card -->
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <div
                                class="icon-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-person-plus fs-3"></i>
                            </div>
                            <h3 class="fw-bold">Create Account</h3>
                            <p class="text-muted">Register as a new user</p>
                        </div>

                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Full Name</label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-person text-muted"></i>
                                    </span>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Enter your full name"
                                               value="{{ old('name') }}"
                                               required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Email Address</label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-envelope text-muted"></i>
                                    </span>
                                        <input type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Enter your email"
                                               value="{{ old('email') }}"
                                               required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Password</label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-lock text-muted"></i>
                                    </span>
                                        <input type="password" name="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Create password"
                                               required>
                                        <span class="input-group-text bg-light" style="cursor: pointer"
                                              onclick="togglePassword(this, 'password')">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted mt-1">Minimum 8 characters</small>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-medium">Confirm Password</label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-lock-fill text-muted"></i>
                                    </span>
                                        <input type="password" name="password_confirmation"
                                               class="form-control"
                                               placeholder="Confirm password"
                                               required>
                                        <span class="input-group-text bg-light" style="cursor: pointer"
                                              onclick="togglePassword(this, 'confirm')">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label text-muted" for="terms">
                                    I agree to the <a href="#" class="text-decoration-none">Terms & Conditions</a> and
                                    <a href="#" class="text-decoration-none">Privacy Policy</a>
                                </label>
                                @error('terms')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-medium mb-3">
                                <i class="bi bi-person-plus me-2"></i>
                                Create Account
                            </button>

                            <!-- Role Assignment Note -->
                            <div class="alert alert-light border">
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    <strong>Note:</strong> All new registrations receive the <span
                                        class="badge bg-info">User</span> role by default.
                                    Additional permissions can be requested from the administrator.
                                </small>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center mt-3">
                                <p class="text-muted mb-0">Already have an account?</p>
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary mt-2">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>
                                    Sign In
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(element, type) {
            let inputName = type === 'confirm' ? 'password_confirmation' : 'password';
            const passwordInput = element.closest('.input-group').querySelector(`input[name="${inputName}"]`);
            const icon = element.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>

    <style>
        .card {
            border-radius: 16px;
        }

        .icon-circle {
            border-radius: 50%;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
            border-color: #667eea;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .alert-light {
            border-radius: 10px;
        }

        .badge {
            font-size: 0.75em;
            padding: 0.25em 0.75em;
        }
    </style>
@endsection
