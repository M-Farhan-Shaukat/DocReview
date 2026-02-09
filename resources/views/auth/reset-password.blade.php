@extends('layouts.user')

@section('title', 'Reset Password')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <!-- Reset Password Card -->
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <div
                                class="icon-circle bg-success bg-opacity-10 text-success d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-shield-lock fs-3"></i>
                            </div>
                            <h3 class="fw-bold">Set New Password</h3>
                            <p class="text-muted">Create a strong, secure password</p>
                        </div>

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    <div>
                                        @foreach ($errors->all() as $error)
                                            <div>{{ $error }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Password Reset Form -->
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <!-- Token -->
                            {{--                            <input type="hidden" name="token" value="{{ $token }}">--}}

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label class="form-label fw-medium">Email Address</label>
                                <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-envelope text-muted"></i>
                                </span>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ $email ?? old('email') }}"
                                           required
                                           readonly
                                           style="background-color: #f8f9fa;">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="form-group mb-3">
                                <label class="form-label fw-medium">New Password</label>
                                <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock text-muted"></i>
                                </span>
                                    <input type="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Enter new password"
                                           required
                                           autofocus>
                                    <span class="input-group-text bg-light" style="cursor: pointer"
                                          onclick="togglePassword(this, 'new')">
                                    <i class="bi bi-eye"></i>
                                </span>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted mt-1 d-block">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Must be at least 8 characters with letters and numbers
                                </small>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mb-4">
                                <label class="form-label fw-medium">Confirm Password</label>
                                <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock-fill text-muted"></i>
                                </span>
                                    <input type="password" name="password_confirmation"
                                           class="form-control"
                                           placeholder="Confirm new password"
                                           required>
                                    <span class="input-group-text bg-light" style="cursor: pointer"
                                          onclick="togglePassword(this, 'confirm')">
                                    <i class="bi bi-eye"></i>
                                </span>
                                </div>
                            </div>

                            <!-- Password Strength Meter -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <small class="text-muted">Password strength</small>
                                    <small class="text-muted" id="password-strength-text">Weak</small>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-danger" id="password-strength-bar"
                                         style="width: 25%"></div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success w-100 py-2 fw-medium mb-3">
                                <i class="bi bi-check-circle me-2"></i>
                                Reset Password
                            </button>

                            <!-- Password Requirements -->
                            <div class="alert alert-light border">
                                <small class="text-muted">
                                    <i class="bi bi-shield-check me-1"></i>
                                    <strong>Password Requirements:</strong><br>
                                    • Minimum 8 characters<br>
                                    • At least one uppercase letter<br>
                                    • At least one number<br>
                                    • At least one special character (!@#$%^&*)
                                </small>
                            </div>

                            <!-- Back to Login -->
                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}" class="text-decoration-none">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    Return to Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Note -->
                <div class="text-center mt-4">
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

        // Password strength checker
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.querySelector('input[name="password"]');
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthText = document.getElementById('password-strength-text');

            if (passwordInput) {
                passwordInput.addEventListener('input', function () {
                    const password = this.value;
                    let strength = 0;

                    // Check password criteria
                    if (password.length >= 8) strength += 25;
                    if (/[A-Z]/.test(password)) strength += 25;
                    if (/[0-9]/.test(password)) strength += 25;
                    if (/[!@#$%^&*]/.test(password)) strength += 25;

                    // Update progress bar
                    strengthBar.style.width = strength + '%';

                    // Update color and text
                    if (strength <= 25) {
                        strengthBar.className = 'progress-bar bg-danger';
                        strengthText.textContent = 'Weak';
                    } else if (strength <= 50) {
                        strengthBar.className = 'progress-bar bg-warning';
                        strengthText.textContent = 'Fair';
                    } else if (strength <= 75) {
                        strengthBar.className = 'progress-bar bg-info';
                        strengthText.textContent = 'Good';
                    } else {
                        strengthBar.className = 'progress-bar bg-success';
                        strengthText.textContent = 'Strong';
                    }
                });
            }
        });
    </script>

    <style>
        .card {
            border-radius: 16px;
        }

        .icon-circle {
            border-radius: 50%;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
            border-color: #198754;
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

        .alert {
            border-radius: 10px;
        }

        .progress {
            border-radius: 10px;
        }

        .progress-bar {
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        input[readonly] {
            cursor: not-allowed;
        }
    </style>
@endsection
