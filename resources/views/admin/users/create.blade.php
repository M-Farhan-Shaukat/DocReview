@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-3">
        <!-- Header -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-0 fs-5">Create New User</h4>
                <p class="text-muted mb-0 small">Add a new user to the system</p>
            </div>
            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill">
                <i class="bi bi-person-plus-fill me-1"></i> New
            </span>
        </div>

        <!-- Form Card - Compact -->
        <div class="row">
            <div class="col-12 col-lg-11 col-xl-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3 p-md-4">
                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf

                            <!-- Two column layout for better space utilization -->
                            <div class="row g-3">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-person"></i> Full Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-sm @error('name') is-invalid @enderror"
                                               name="name"
                                               placeholder="Enter full name"
                                               value="{{ old('name') }}"
                                               required>
                                        @error('name')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="email"
                                               class="form-control form-control-sm @error('email') is-invalid @enderror"
                                               name="email"
                                               placeholder="user@example.com"
                                               value="{{ old('email') }}"
                                               required>
                                        @error('email')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-telephone"></i> Phone
                                        </label>
                                        <input type="tel"
                                               class="form-control form-control-sm @error('phone') is-invalid @enderror"
                                               name="phone"
                                               placeholder="+1234567890"
                                               value="{{ old('phone') }}">
                                        @error('phone')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-calendar"></i> Age
                                        </label>
                                        <input type="number"
                                               class="form-control form-control-sm @error('age') is-invalid @enderror"
                                               name="age"
                                               placeholder="25"
                                               value="{{ old('age') }}">
                                        @error('age')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-building"></i> City
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-sm @error('city') is-invalid @enderror"
                                               name="city"
                                               placeholder="New York"
                                               value="{{ old('city') }}">
                                        @error('city')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-postcard"></i> Postal Code
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-sm @error('postal_code') is-invalid @enderror"
                                               name="postal_code"
                                               placeholder="10001"
                                               value="{{ old('postal_code') }}">
                                        @error('postal_code')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-card-text"></i> CNIC
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-sm @error('cnic') is-invalid @enderror"
                                               name="cnic"
                                               placeholder="12345-6789012-3"
                                               id="cnic"
                                               value="{{ old('cnic') }}">
                                        @error('cnic')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-shield"></i> Role <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-select-sm @error('role_id') is-invalid @enderror"
                                                name="role_id"
                                                required>
                                            <option value="" disabled selected>Select role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-key"></i> Password <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password"
                                                   placeholder="Password"
                                                   id="password"
                                                   required>
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                                <i class="bi bi-eye" id="passwordIcon"></i>
                                            </button>
                                            @error('password')
                                            <div class="invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted">Min 8 characters</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-check-circle"></i> Confirm Password <span class="text-danger">*</span>
                                        </label>
                                        <input type="password"
                                               class="form-control form-control-sm"
                                               name="password_confirmation"
                                               placeholder="Confirm password"
                                               id="password_confirmation">
                                    </div>
                                </div>

                                <!-- Account Status - Full Width -->
                                <div class="col-12">
                                    <div class="d-flex align-items-center bg-light p-2 rounded-3 mt-2">
                                        <div class="form-check form-switch me-3">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                                            <label class="form-check-label small fw-semibold" for="isActive">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="email_verified" id="emailVerified">
                                            <label class="form-check-label small fw-semibold" for="emailVerified">
                                                Verify Email
                                            </label>
                                        </div>
                                        <small class="text-muted ms-auto">
                                            <i class="bi bi-info-circle"></i> User will receive welcome email
                                        </small>
                                    </div>
                                </div>

                                <!-- Password Match Indicator -->
                                <div class="col-12">
                                    <div id="passwordMatch" class="small"></div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-2 border-top">
                                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="bi bi-eraser"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bi bi-check-circle"></i> Save User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Quick Tips - Compact -->
                <div class="alert alert-info bg-opacity-10 border-0 mt-3 p-2 small">
                    <i class="bi bi-info-circle me-1"></i>
                    <span class="fw-semibold">Quick tips:</span>
                    <span class="text-muted">Required fields marked with * | Password must be 8+ chars | CNIC auto-formats</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Compact form styling - respects sidebar */
        .container-fluid {
            max-width: 100%;
            overflow-x: hidden;
        }

        .card {
            border-radius: 0.75rem;
            border: none;
        }

        .form-control-sm, .form-select-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
        }

        .form-control-sm:focus, .form-select-sm:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
        }

        .input-group-sm .form-control {
            border-radius: 0.5rem 0 0 0.5rem;
        }

        .input-group-sm .btn {
            border-radius: 0 0.5rem 0.5rem 0;
            padding: 0.35rem 0.75rem;
        }

        .form-label {
            margin-bottom: 0.2rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .bg-opacity-10 {
            --bs-bg-opacity: 0.1;
        }

        .btn-sm {
            padding: 0.35rem 0.9rem;
            font-size: 0.8rem;
            border-radius: 0.5rem;
        }

        .btn-success {
            background: linear-gradient(145deg, #198754, #146c43);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(145deg, #146c43, #0f5735);
        }

        .form-check-input {
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }

        /* Compact spacing */
        .mb-3 {
            margin-bottom: 0.75rem !important;
        }

        .row.g-3 {
            --bs-gutter-y: 0.75rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .col-lg-11, .col-xl-10 {
                width: 100%;
            }

            .card-body {
                padding: 1rem !important;
            }
        }

        /* Password match indicator */
        .text-success small, .text-danger small {
            font-size: 0.75rem;
        }

        /* Ensure sidebar stays intact */
        .d-flex {
            align-items: stretch;
        }

        .flex-grow-1 {
            min-width: 0; /* Prevents flex item from overflowing */
            overflow-x: hidden;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Password match checker
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const confirm = document.getElementById('password_confirmation');
            const matchDiv = document.getElementById('passwordMatch');

            if (confirm) {
                confirm.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        if (password.value === this.value) {
                            matchDiv.innerHTML = '<span class="text-success"><i class="bi bi-check-circle-fill"></i> Passwords match</span>';
                            this.classList.remove('is-invalid');
                            this.classList.add('is-valid');
                        } else {
                            matchDiv.innerHTML = '<span class="text-danger"><i class="bi bi-exclamation-circle-fill"></i> Passwords do not match</span>';
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

        // Auto-format CNIC
        document.getElementById('cnic')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 5) {
                value = value.slice(0, 5) + '-' + value.slice(5);
            }
            if (value.length > 13) {
                value = value.slice(0, 13) + '-' + value.slice(13, 14);
            }
            e.target.value = value;
        });
    </script>
@endpush
