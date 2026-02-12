@extends('layouts.user')

@section('title', 'Forgot Password')

@section('content')
    <div class="container py-3 py-md-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <!-- Forgot Password Card -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-3 p-sm-4 p-md-5">
                        <!-- Header -->
                        <div class="text-center mb-3 mb-md-4">
                            <div class="icon-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-2 mb-md-3"
                                 style="width: 55px; height: 55px;">
                                <i class="bi bi-key fs-3"></i>
                            </div>
                            <h3 class="fw-bold mb-1 fs-4 fs-md-3">Reset Password</h3>
                            <p class="text-muted small mb-0">Enter your email to receive a reset link</p>
                        </div>

                        <!-- Success Message -->
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-3 small" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill me-2 flex-shrink-0"></i>
                                    <span class="flex-grow-1">{{ session('status') }}</span>
                                </div>
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3 small" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle me-2 flex-shrink-0"></i>
                                    <span class="flex-grow-1">{{ $errors->first() }}</span>
                                </div>
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Password Reset Form -->
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Input -->
                            <div class="form-group mb-4">
                                <label class="form-label fw-medium small text-secondary mb-1">Email Address</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light border-end-0 ps-3">
                                        <i class="bi bi-envelope text-muted"></i>
                                    </span>
                                    <input type="email" name="email"
                                           class="form-control border-start-0 @error('email') is-invalid @enderror"
                                           placeholder="your@email.com"
                                           value="{{ old('email') }}"
                                           required
                                           autofocus>
                                    @error('email')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted d-block mt-2 small">
                                    <i class="bi bi-info-circle me-1"></i>
                                    We'll send a password reset link to this email
                                </small>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-medium rounded-3 mb-4">
                                <i class="bi bi-send me-2"></i>
                                Send Reset Link
                            </button>

                            <!-- Instructions -->
                            <div class="alert alert-light border-0 bg-light py-2 px-3 rounded-3 mb-3">
                                <small class="text-muted d-flex flex-column gap-1">
                                    <span class="fw-semibold">
                                        <i class="bi bi-info-circle me-1 text-primary"></i>Instructions:
                                    </span>
                                    <span class="ms-3">• Enter your registered email address</span>
                                    <span class="ms-3">• Check your inbox for the reset link</span>
                                    <span class="ms-3">• Click the link to set a new password</span>
                                    <span class="ms-3">• Link expires in 60 minutes</span>
                                </small>
                            </div>

                            <!-- Back to Login -->
                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}" class="text-decoration-none d-inline-flex align-items-center small">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    Back to Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Support Info -->
                <div class="text-center mt-3">
                    <small class="text-muted">
                        <i class="bi bi-headset me-1"></i>
                        Need help? <a href="#" class="text-decoration-none">Contact Support</a>
                    </small>
                </div>
            </div>
        </div>
    </div>

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

        .btn-primary:active {
            transform: translateY(0);
        }

        .input-group-text {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .input-group .form-control {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .alert {
            border-radius: 12px;
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
        }

        @media (min-width: 576px) and (max-width: 767.98px) {
            .card-body {
                padding: 2rem !important;
            }
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
    </style>
@endsection
