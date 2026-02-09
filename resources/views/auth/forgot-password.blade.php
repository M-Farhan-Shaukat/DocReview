@extends('layouts.user')

@section('title', 'Forgot Password')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <!-- Forgot Password Card -->
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <div
                                class="icon-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-key fs-3"></i>
                            </div>
                            <h3 class="fw-bold">Reset Password</h3>
                            <p class="text-muted">Enter your email to receive a reset link</p>
                        </div>

                        <!-- Success Message -->
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                                    <div>
                                        {{ session('status') }}
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    <div>{{ $errors->first() }}</div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Password Reset Form -->
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Input -->
                            <div class="form-group mb-4">
                                <label class="form-label fw-medium">Email Address</label>
                                <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-envelope text-muted"></i>
                                </span>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Enter your registered email"
                                           value="{{ old('email') }}"
                                           required
                                           autofocus>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted mt-1">We'll send a password reset link to this email</small>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-medium mb-4">
                                <i class="bi bi-send me-2"></i>
                                Send Reset Link
                            </button>

                            <!-- Instructions -->
                            <div class="alert alert-light border">
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    <strong>Instructions:</strong><br>
                                    • Enter your registered email address<br>
                                    • Check your inbox for the reset link<br>
                                    • Click the link to set a new password<br>
                                    • Link expires in 60 minutes
                                </small>
                            </div>

                            <!-- Back to Login -->
                            <div class="text-center mt-4">
                                <a href="{{ route('login') }}"
                                   class="text-decoration-none d-inline-flex align-items-center">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    Back to Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Support Info -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        Need help? <a href="#" class="text-decoration-none">Contact Support</a>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 16px;
            overflow: hidden;
        }

        .icon-circle {
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
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

        .alert {
            border-radius: 10px;
        }

        .alert-success {
            background-color: rgba(25, 135, 84, 0.1);
            border-color: rgba(25, 135, 84, 0.2);
            color: #198754;
        }

        .alert-light {
            background-color: #f8f9fa;
        }
    </style>
@endsection
