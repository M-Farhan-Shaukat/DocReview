@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-3">
        <!-- Header -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-0 fs-5">Edit User</h4>
                <p class="text-muted mb-0 small">Update user information and settings</p>
            </div>
            <div class="d-flex gap-2">
                <span class="badge bg-info bg-opacity-10 text-info px-2 py-1 rounded-pill">
                    <i class="bi bi-pencil-square me-1"></i> Editing
                </span>
                <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }} bg-opacity-10 px-2 py-1 rounded-pill"
                      style="color: {{ $user->is_active ? '#198754' : '#dc3545' }} !important;">
                    <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>
                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>

        <!-- Form Card - Compact -->
        <div class="row">
            <div class="col-12 col-lg-11 col-xl-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-3 p-md-4">
                        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                            @csrf
                            @method('PUT')

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
                                               value="{{ old('name', $user->name) }}"
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
                                               value="{{ old('email', $user->email) }}"
                                               required>
                                        @error('email')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                        @if($user->email_verified_at)
                                            <small class="text-success d-block mt-1">
                                                <i class="bi bi-check-circle-fill me-1" style="font-size: 0.7rem;"></i>
                                                Verified: {{ $user->email_verified_at->format('M d, Y') }}
                                            </small>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-telephone"></i> Phone
                                        </label>
                                        <input type="tel"
                                               class="form-control form-control-sm @error('phone') is-invalid @enderror"
                                               name="phone"
                                               placeholder="+1234567890"
                                               value="{{ old('phone', $user->phone) }}">
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
                                               min="1"
                                               max="120"
                                               value="{{ old('age', $user->age) }}">
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
                                               value="{{ old('city', $user->city) }}">
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
                                               value="{{ old('postal_code', $user->postal_code) }}">
                                        @error('postal_code')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-card-text"></i> CNIC / ID
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-sm @error('cnic') is-invalid @enderror"
                                               name="cnic"
                                               placeholder="12345-6789012-3"
                                               id="cnic"
                                               value="{{ old('cnic', $user->cnic) }}">
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
                                            <option value="" disabled>Select role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
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
                                            <i class="bi bi-key"></i> New Password
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password"
                                                   placeholder="Leave empty to keep current"
                                                   id="password">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                                <i class="bi bi-eye" id="passwordIcon"></i>
                                            </button>
                                            @error('password')
                                            <div class="invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted">Min 8 characters. Leave empty to keep current password.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-secondary mb-1">
                                            <i class="bi bi-check-circle"></i> Confirm Password
                                        </label>
                                        <input type="password"
                                               class="form-control form-control-sm"
                                               name="password_confirmation"
                                               placeholder="Confirm new password"
                                               id="password_confirmation">
                                    </div>
                                </div>

                                <!-- Account Status Controls - Full Width -->
                                <div class="col-12">
                                    <div class="d-flex flex-wrap align-items-center bg-light p-2 rounded-3 mt-2">
                                        <div class="form-check form-switch me-4">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive"
                                                {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label small fw-semibold" for="isActive">
                                                <i class="bi bi-check-circle text-success me-1"></i> Active Account
                                            </label>
                                        </div>

                                        @if(!$user->email_verified_at)
                                            <div class="form-check form-switch me-4">
                                                <input class="form-check-input" type="checkbox" name="email_verified" id="emailVerified">
                                                <label class="form-check-label small fw-semibold" for="emailVerified">
                                                    <i class="bi bi-envelope-check text-info me-1"></i> Mark Email Verified
                                                </label>
                                            </div>
                                        @endif

                                        <div class="ms-auto">
                                            <small class="text-muted">
                                                <i class="bi bi-clock-history me-1"></i>
                                                Updated: {{ $user->updated_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Match Indicator -->
                                <div class="col-12">
                                    <div id="passwordMatch" class="small"></div>
                                </div>

                                <!-- User Meta Info -->
                                <div class="col-12">
                                    <div class="d-flex flex-wrap gap-3 mt-1 small text-muted">
                                        <span><i class="bi bi-calendar-plus me-1"></i> Created: {{ $user->created_at->format('M d, Y') }}</span>
                                        @if($user->email_verified_at)
                                            <span><i class="bi bi-envelope-check me-1 text-success"></i> Email verified</span>
                                        @else
                                            <span><i class="bi bi-envelope me-1 text-warning"></i> Email not verified</span>
                                        @endif
                                        <span><i class="bi bi-fingerprint me-1"></i> ID: {{ $user->id }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-2 border-top">
                                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Users
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="bi bi-eraser"></i> Reset Changes
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bi bi-check-circle"></i> Update User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Danger Zone - For Admins Only -->
                @if(auth()->user()->hasPermission('delete_users') && auth()->user()->id !== $user->id)
                    <div class="card border-0 bg-danger bg-opacity-10 mt-3">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="fw-semibold text-danger mb-1">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Danger Zone
                                    </h6>
                                    <p class="small text-muted mb-0">Once you delete a user, there is no going back.</p>
                                </div>
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteUserModal">
                                    <i class="bi bi-trash"></i> Delete User
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteUserModal" tabindex="-1">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header border-0 pb-0">
                                    <h6 class="modal-title text-danger fw-semibold">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Delete User
                                    </h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="small mb-0">Are you sure you want to delete <strong>{{ $user->name }}</strong>?</p>
                                    <p class="small text-muted mt-2 mb-0">This action cannot be undone.</p>
                                </div>
                                <div class="modal-footer border-0 pt-0">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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

        .btn-primary {
            background: linear-gradient(145deg, #0d6efd, #0b5ed7);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(145deg, #0b5ed7, #0a58ca);
        }

        .form-check-input {
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
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

        /* Danger zone styling */
        .bg-opacity-10.bg-danger {
            background-color: rgba(220, 53, 69, 0.05) !important;
        }

        /* Tooltip customization */
        .small {
            font-size: 0.75rem;
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

        // Warn before leaving with unsaved changes
        (function() {
            const form = document.querySelector('form');
            const resetButton = document.querySelector('button[type="reset"]');
            let formChanged = false;

            if (form) {
                form.addEventListener('input', function() {
                    formChanged = true;
                });

                if (resetButton) {
                    resetButton.addEventListener('click', function() {
                        formChanged = false;
                    });
                }

                window.addEventListener('beforeunload', function(e) {
                    if (formChanged) {
                        e.preventDefault();
                        e.returnValue = '';
                    }
                });

                form.addEventListener('submit', function() {
                    formChanged = false;
                });
            }
        })();
    </script>
@endpush
