@extends('layouts.user')

@section('title', 'Reset Password')

@section('content')
    <div class="container py-3 py-md-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <!-- Reset Password Card -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-3 p-sm-4 p-md-5">
                        <!-- Header -->
                        <div class="text-center mb-3 mb-md-4">
                            <div class="icon-circle bg-success bg-opacity-10 text-success d-inline-flex align-items-center justify-content-center mb-2 mb-md-3"
                                 style="width: 55px; height: 55px;">
                                <i class="bi bi-shield-lock fs-3"></i>
                            </div>
                            <h3 class="fw-bold mb-1 fs-4 fs-md-3">Set New Password</h3>
                            <p class="text-muted small mb-0">Create a strong, secure password</p>
                        </div>

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3 small" role="alert">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-exclamation-triangle me-2 flex-shrink-0 mt-1"></i>
                                    <div class="flex-grow-1">
                                        @foreach ($errors->all() as $error)
                                            <div>{{ $error }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-3 small" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle me-2 flex-shrink-0"></i>
                                    <span class="flex-grow-1">{{ session('status') }}</span>
                                </div>
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Password Reset Form -->
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <!-- Token -->
                            <input type="hidden" name="token" value="{{ $token ?? '' }}">

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label class="form-label fw-medium small text-secondary mb-1">Email Address</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light border-end-0 ps-3">
                                        <i class="bi bi-envelope text-muted"></i>
                                    </span>
                                    <input type="email" name="email"
                                           class="form-control border-start-0 @error('email') is-invalid @enderror"
                                           value="{{ $email ?? old('email') }}"
                                           required
                                           readonly
                                           style="background-color: #f8f9fa;">
                                    @error('email')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="form-group mb-3">
                                <label class="form-label fw-medium small text-secondary mb-1">New Password</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light border-end-0 ps-3">
                                        <i class="bi bi-lock text-muted"></i>
                                    </span>
                                    <input type="password" name="password"
                                           class="form-control border-start-0 @error('password') is-invalid @enderror"
                                           placeholder="Enter new password"
                                           id="password"
                                           required
                                           autofocus>
                                    <button class="btn btn-outline-secondary bg-light border"
                                            type="button"
                                            onclick="togglePassword(this, 'new')"
                                            style="border-top-right-radius: 0.375rem; border-bottom-right-radius: 0.375rem;">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    @error('password')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mb-3">
                                <label class="form-label fw-medium small text-secondary mb-1">Confirm Password</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light border-end-0 ps-3">
                                        <i class="bi bi-lock-fill text-muted"></i>
                                    </span>
                                    <input type="password" name="password_confirmation"
                                           class="form-control border-start-0"
                                           placeholder="Confirm new password"
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

                            <!-- Password Strength Meter -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <small class="text-muted">Password strength</small>
                                    <small class="text-muted fw-medium" id="password-strength-text">Weak</small>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 10px;">
                                    <div class="progress-bar bg-danger" id="password-strength-bar"
                                         style="width: 25%; border-radius: 10px;"></div>
                                </div>
                            </div>

                            <!-- Password Match Indicator -->
                            <div class="mb-3">
                                <div id="passwordMatch" class="small"></div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success w-100 py-2 fw-medium rounded-3 mb-3">
                                <i class="bi bi-check-circle me-2"></i>
                                Reset Password
                            </button>

                            <!-- Password Requirements -->
                            <div class="alert alert-light border-0 bg-light py-2 px-3 rounded-3 mb-3">
                                <small class="text-muted d-flex flex-column gap-1">
                                    <span class="fw-semibold">
                                        <i class="bi bi-shield-check me-1 text-success"></i>Password Requirements:
                                    </span>
                                    <span class="ms-3">• Minimum 8 characters</span>
                                    <span class="ms-3">• At least one uppercase letter</span>
                                    <span class="ms-3">• At least one number</span>
                                    <span class="ms-3">• At least one special character (!@#$%^&*)</span>
                                </small>
                            </div>

                            <!-- Back to Login -->
                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}" class="text-decoration-none d-inline-flex align-items-center small">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    Return to Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Note -->
                <div class="text-center mt-3">
                    <small class="text-muted">
                        <i class="bi bi-shield-lock me-1"></i>
                        This is a secure, encrypted connection
                    </small>
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

        // Password strength checker
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.querySelector('input[name="password"]');
            const confirmInput = document.getElementById('password_confirmation');
            const matchDiv = document.getElementById('passwordMatch');
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthText = document.getElementById('password-strength-text');

            if (passwordInput) {
                passwordInput.addEventListener('input', function () {
                    const password = this.value;
                    let strength = 0;
                    let criteria = 0;

                    // Check password criteria
                    if (password.length >= 8) {
                        strength += 25;
                        criteria++;
                    }
                    if (/[A-Z]/.test(password)) {
                        strength += 25;
                        criteria++;
                    }
                    if (/[0-9]/.test(password)) {
                        strength += 25;
                        criteria++;
                    }
                    if (/[!@#$%^&*]/.test(password)) {
                        strength += 25;
                        criteria++;
                    }

                    // Update progress bar
                    strengthBar.style.width = strength + '%';

                    // Update color and text
                    if (strength <= 25) {
                        strengthBar.className = 'progress-bar bg-danger';
                        strengthText.textContent = 'Weak';
                        strengthText.className = 'text-muted fw-medium text-danger';
                    } else if (strength <= 50) {
                        strengthBar.className = 'progress-bar bg-warning';
                        strengthText.textContent = 'Fair';
                        strengthText.className = 'text-muted fw-medium text-warning';
                    } else if (strength <= 75) {
                        strengthBar.className = 'progress-bar bg-info';
                        strengthText.textContent = 'Good';
                        strengthText.className = 'text-muted fw-medium text-info';
                    } else {
                        strengthBar.className = 'progress-bar bg-success';
                        strengthText.textContent = 'Strong';
                        strengthText.className = 'text-muted fw-medium text-success';
                    }
                });
            }

            // Password match checker
            if (confirmInput) {
                confirmInput.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        if (passwordInput.value === this.value) {
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
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
            border-color: #20c997;
        }

        .btn-success {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
            transition: all 0.3s;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
        }

        .btn-success:active {
            transform: translateY(0);
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

        .progress {
            background-color: #e9ecef;
            border-radius: 10px;
        }

        .progress-bar {
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        input[readonly] {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        @media (max-width: 575.98px) {
            .card-body {
                padding: 1.5rem !important;
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

            .progress {
                height: 5px !important;
            }
        }

        @media (min-width: 576px) and (max-width: 767.98px) {
            .card-body {
                padding: 2rem !important;
            }
        }

        .alert {
            border-radius: 12px;
        }

        .alert-success {
            background-color: rgba(25, 135, 84, 0.1);
            border-color: rgba(25, 135, 84, 0.2);
            color: #198754;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            border-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        .alert-light {
            background-color: #f8f9fa;
        }

        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }
    </style>
@endsection
