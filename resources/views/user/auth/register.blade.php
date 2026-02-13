@extends('user.layouts.app')

@section('title', 'Sign Up')

@section('content')
    <div class="container py-3 py-md-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <!-- Registration Card -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-3 p-sm-4 p-md-5">
                        <!-- Header -->
                        <div class="text-center mb-3 mb-md-4">
                            <div
                                class="icon-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-2 mb-md-3"
                                style="width: 55px; height: 55px;">
                                <i class="bi bi-person-plus fs-3"></i>
                            </div>
                            <h3 class="fw-bold mb-1 fs-4 fs-md-3">Create Account</h3>
                            <p class="text-muted small mb-0">Register as a new user</p>
                        </div>

                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-3 small"
                                 role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle me-2 flex-shrink-0"></i>
                                    <span class="flex-grow-1">{{ session('success') }}</span>
                                </div>
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf

                            <div class="row g-2 g-md-3">
                                <!-- Name -->
                                <div class="col-12 col-md-6 mb-2 mb-md-3">
                                    <label class="form-label fw-medium small text-secondary mb-1">Full Name</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light border-end-0 ps-3">
                                            <i class="bi bi-person text-muted"></i>
                                        </span>
                                        <input type="text" name="name"
                                               class="form-control border-start-0 @error('name') is-invalid @enderror"
                                               placeholder="John Doe"
                                               value="{{ old('name') }}"
                                               required>
                                        @error('name')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-12 col-md-6 mb-2 mb-md-3">
                                    <label class="form-label fw-medium small text-secondary mb-1">Email Address</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light border-end-0 ps-3">
                                            <i class="bi bi-envelope text-muted"></i>
                                        </span>
                                        <input type="email" name="email"
                                               class="form-control border-start-0 @error('email') is-invalid @enderror"
                                               placeholder="john@example.com"
                                               value="{{ old('email') }}"
                                               required>
                                        @error('email')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 g-md-3">
                                <!-- Password -->
                                <div class="col-12 col-md-6 mb-2 mb-md-3">
                                    <label class="form-label fw-medium small text-secondary mb-1">Password</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light border-end-0 ps-3">
                                            <i class="bi bi-lock text-muted"></i>
                                        </span>
                                        <input type="password" name="password"
                                               class="form-control border-start-0 @error('password') is-invalid @enderror"
                                               placeholder="Create password"
                                               id="password"
                                               required>
                                        <button class="btn btn-outline-secondary bg-light border"
                                                type="button"
                                                onclick="togglePassword(this, 'password')"
                                                style="border-top-right-radius: 0.375rem; border-bottom-right-radius: 0.375rem;">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        @error('password')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted d-block mt-1 small">Minimum 8 characters</small>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-12 col-md-6 mb-3 mb-md-4">
                                    <label class="form-label fw-medium small text-secondary mb-1">Confirm
                                        Password</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light border-end-0 ps-3">
                                            <i class="bi bi-lock-fill text-muted"></i>
                                        </span>
                                        <input type="password" name="password_confirmation"
                                               class="form-control border-start-0"
                                               placeholder="Confirm password"
                                               id="password_confirmation"
                                               required>
                                        <button class="btn btn-outline-secondary bg-light border"
                                                type="button"
                                                onclick="togglePassword(this, 'confirm')"
                                                style="border-top-right-radius: 0.375rem; border-bottom-right-radius: 0.375rem;">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Match Indicator -->
                            <div class="col-12 mb-2">
                                <div id="passwordMatch" class="small"></div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label small text-muted" for="terms">
                                    I agree to the <a href="#" class="text-decoration-none">Terms & Conditions</a> and
                                    <a href="#" class="text-decoration-none">Privacy Policy</a>
                                </label>
                                @error('terms')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-medium rounded-3 mb-3">
                                <i class="bi bi-person-plus me-2"></i>
                                Create Account
                            </button>

                            <!-- Role Assignment Note -->
                            <div class="alert alert-light border-0 bg-light py-2 px-3 rounded-3 mb-3">
                                <small class="text-muted d-flex align-items-center">
                                    <i class="bi bi-info-circle me-2 text-primary"></i>
                                    <span>All new registrations receive the <span
                                            class="badge bg-info bg-opacity-10 text-info px-2 py-1">User</span> role by default.</span>
                                </small>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center mt-3">
                                <p class="text-muted small mb-1">Already have an account?</p>
                                <a href="{{ route('login') }}"
                                   class="btn btn-outline-secondary btn-sm py-2 px-4 rounded-3">
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

            if (passwordInput) {
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
        }

        // Password match checker
        document.addEventListener('DOMContentLoaded', function () {
            const password = document.getElementById('password');
            const confirm = document.getElementById('password_confirmation');
            const matchDiv = document.getElementById('passwordMatch');

            if (confirm) {
                confirm.addEventListener('input', function () {
                    if (this.value.length > 0) {
                        if (password.value === this.value) {
                            matchDiv.innerHTML = '<span class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Passwords match</span>';
                            this.classList.remove('is-invalid');
                            this.classList.add('is-valid');
                        } else {
                            matchDiv.innerHTML = '<span class="text-danger"><i class="bi bi-exclamation-circle-fill me-1"></i> Passwords do not match</span>';
                            this.classList.remove('is-valid');
                            this.classList.add('is-invalid');
                        }
                    } else {
                        matchDiv.innerHTML = '';
                        this.classList.remove('is-valid', 'is-invalid');
                    }
                });
            }
        });
    </script>

    <style>
        .card {
            border-radius: 20px !important;
            transition: all 0.3s ease;
        }

        .icon-circle {
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
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

        .input-group-text {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .input-group .btn {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            border: 1px solid #dee2e6;
            border-left: none;
        }

        .badge {
            font-weight: 500;
        }

        @media (max-width: 575.98px) {
            .card-body {
                padding: 1.25rem !important;
            }

            .icon-circle {
                width: 50px !important;
                height: 50px !important;
            }

            .icon-circle i {
                font-size: 1.5rem !important;
            }

            h3 {
                font-size: 1.35rem !important;
            }

            .row {
                margin-left: -0.25rem;
                margin-right: -0.25rem;
            }

            .col-12 {
                padding-left: 0.25rem;
                padding-right: 0.25rem;
            }
        }

        @media (min-width: 576px) and (max-width: 767.98px) {
            .card-body {
                padding: 2rem !important;
            }
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .btn-outline-secondary {
            border-color: #dee2e6;
        }

        .btn-outline-secondary:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
    </style>
@endsection
