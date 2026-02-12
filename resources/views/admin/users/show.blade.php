@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-3">
        <!-- Header -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-0 fs-5">User Profile</h4>
                <p class="text-muted mb-0 small">Detailed information about the user</p>
            </div>
            <div class="d-flex gap-2">
                <span class="badge bg-info bg-opacity-10 text-info px-2 py-1 rounded-pill">
                    <i class="bi bi-person-badge me-1"></i> Profile
                </span>
                <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }} bg-opacity-10 px-2 py-1 rounded-pill"
                      style="color: {{ $user->is_active ? '#198754' : '#dc3545' }} !important;">
                    <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>
                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-12 col-lg-11 col-xl-10">
                <!-- Profile Card -->
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body p-4">
                        <!-- Profile Header with Avatar -->
                        <div class="d-flex flex-wrap align-items-start gap-4 mb-4">
                            <!-- User Avatar -->
                            <div class="position-relative">
                                <div class="rounded-circle bg-gradient-primary d-flex align-items-center justify-content-center"
                                     style="width: 80px; height: 80px; background: linear-gradient(145deg, #0d6efd, #0b5ed7);">
                                    <span class="fw-bold text-white fs-2">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="position-absolute bottom-0 end-0">
                                    <span class="badge rounded-pill bg-white border p-2 shadow-sm">
                                        <i class="bi bi-check-circle-fill {{ $user->is_active ? 'text-success' : 'text-secondary' }}"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- User Title -->
                            <div class="flex-grow-1">
                                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                        <i class="bi bi-shield me-1"></i> {{ $user->role->name ?? 'No Role' }}
                                    </span>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                        <i class="bi bi-fingerprint me-1"></i> ID: #{{ $user->id }}
                                    </span>
                                </div>
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-calendar-plus me-1"></i> Member since {{ $user->created_at->format('F d, Y') }}
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </a>
                                <a href="{{ route('admin.users') }}"
                                   class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Back
                                </a>
                            </div>
                        </div>

                        <!-- User Information Tabs -->
                        <ul class="nav nav-tabs nav-tabs-light mb-3" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button">
                                    <i class="bi bi-person me-1"></i> Personal Information
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button">
                                    <i class="bi bi-shield-lock me-1"></i> Account Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button">
                                    <i class="bi bi-clock-history me-1"></i> Activity
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <!-- Personal Information Tab -->
                            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="info-card p-3 bg-light rounded-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="info-icon">
                                                    <i class="bi bi-envelope fs-5 text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted text-uppercase">Email Address</small>
                                                    <p class="fw-semibold mb-0">{{ $user->email }}</p>
                                                    @if($user->email_verified_at)
                                                        <span class="badge bg-success bg-opacity-10 text-success mt-1">
                                                            <i class="bi bi-check-circle-fill me-1"></i> Verified
                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning bg-opacity-10 text-warning mt-1">
                                                            <i class="bi bi-exclamation-circle me-1"></i> Not Verified
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-card p-3 bg-light rounded-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="info-icon">
                                                    <i class="bi bi-telephone fs-5 text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted text-uppercase">Phone Number</small>
                                                    <p class="fw-semibold mb-0">{{ $user->phone ?? 'Not provided' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-card p-3 bg-light rounded-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="info-icon">
                                                    <i class="bi bi-calendar fs-5 text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted text-uppercase">Age</small>
                                                    <p class="fw-semibold mb-0">{{ $user->age ?? 'Not provided' }} years</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-card p-3 bg-light rounded-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="info-icon">
                                                    <i class="bi bi-building fs-5 text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted text-uppercase">City</small>
                                                    <p class="fw-semibold mb-0">{{ $user->city ?? 'Not provided' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-card p-3 bg-light rounded-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="info-icon">
                                                    <i class="bi bi-postcard fs-5 text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted text-uppercase">Postal Code</small>
                                                    <p class="fw-semibold mb-0">{{ $user->postal_code ?? 'Not provided' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="info-card p-3 bg-light rounded-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="info-icon">
                                                    <i class="bi bi-card-text fs-5 text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted text-uppercase">CNIC / ID Number</small>
                                                    <p class="fw-semibold mb-0">{{ $user->cnic ?? 'Not provided' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Account Details Tab -->
                            <div class="tab-pane fade" id="account" role="tabpanel">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="info-card p-3 bg-light rounded-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="info-icon">
                                                    <i class="bi bi-shield fs-5 text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted text-uppercase">Role</small>
                                                    <p class="fw-semibold mb-0">{{ $user->role->name ?? 'No Role' }}</p>
                                                    @if($user->role)
                                                        <small class="text-muted">{{ $user->role->description ?? '' }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-card p-3 bg-light rounded-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="info-icon">
                                                    <i class="bi bi-circle-fill {{ $user->is_active ? 'text-success' : 'text-danger' }} fs-5"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted text-uppercase">Account Status</small>
                                                    <div>
                                                        @if($user->is_active)
                                                            <span class="badge bg-success">Active</span>
                                                            <small class="text-muted d-block mt-1">User can log in to the system</small>
                                                        @else
                                                            <span class="badge bg-danger">Inactive</span>
                                                            <small class="text-muted d-block mt-1">User cannot access the system</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-card p-3 bg-light rounded-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="info-icon">
                                                    <i class="bi bi-calendar-plus fs-5 text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted text-uppercase">Created At</small>
                                                    <p class="fw-semibold mb-0">{{ $user->created_at->format('F d, Y h:i A') }}</p>
                                                    <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-card p-3 bg-light rounded-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="info-icon">
                                                    <i class="bi bi-calendar-check fs-5 text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted text-uppercase">Last Updated</small>
                                                    <p class="fw-semibold mb-0">{{ $user->updated_at->format('F d, Y h:i A') }}</p>
                                                    <small class="text-muted">{{ $user->updated_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity Tab -->
                            <div class="tab-pane fade" id="activity" role="tabpanel">
                                <div class="text-center py-4">
                                    <div class="mb-3">
                                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-4">
                                            <i class="bi bi-clock-history fs-2 text-muted"></i>
                                        </div>
                                    </div>
                                    <h6 class="fw-semibold mb-2">No Activity Logs</h6>
                                    <p class="small text-muted mb-0">Activity tracking will be available soon.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Cards -->
                <div class="row g-3">
                    <!-- Quick Actions -->
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body p-3">
                                <h6 class="fw-semibold mb-3">
                                    <i class="bi bi-lightning-charge text-primary me-2"></i>
                                    Quick Actions
                                </h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil me-1"></i> Edit Profile
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm {{ $user->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#statusModal{{ $user->id }}">
                                        <i class="bi bi-{{ $user->is_active ? 'slash-circle' : 'check-circle' }} me-1"></i>
                                        {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                    @if(auth()->user()->hasPermission('delete_users') && auth()->id() !== $user->id)
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $user->id }}">
                                            <i class="bi bi-trash me-1"></i> Delete
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Meta -->
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body p-3">
                                <h6 class="fw-semibold mb-3">
                                    <i class="bi bi-info-circle text-primary me-2"></i>
                                    User Meta
                                </h6>
                                <div class="d-flex flex-column gap-1 small">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">User ID:</span>
                                        <span class="fw-medium">#{{ $user->id }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Email Verified:</span>
                                        @if($user->email_verified_at)
                                            <span class="text-success">{{ $user->email_verified_at->format('M d, Y') }}</span>
                                        @else
                                            <span class="text-warning">Not verified</span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Last Login:</span>
                                        <span class="text-muted">Not available</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Modal -->
    <div class="modal fade" id="statusModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow">
                <div class="modal-body p-4 text-center position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>

                    <div class="d-flex justify-content-center mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center p-3
                            {{ $user->is_active ? 'bg-warning bg-opacity-10' : 'bg-success bg-opacity-10' }}"
                             style="width: 64px; height: 64px;">
                            <i class="bi bi-{{ $user->is_active ? 'exclamation-triangle' : 'check-circle' }}
                                {{ $user->is_active ? 'text-warning' : 'text-success' }} fs-3"></i>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-1 {{ $user->is_active ? 'text-warning' : 'text-success' }}">
                        {{ $user->is_active ? 'Deactivate' : 'Activate' }} User
                    </h5>

                    <p class="small text-muted mb-3">
                        {{ $user->is_active ? 'This will revoke system access' : 'This will grant system access' }}
                    </p>

                    <div class="bg-light rounded-3 p-3 mb-3 text-start">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center shadow-sm"
                                 style="width: 40px; height: 40px;">
                                <span class="fw-bold text-primary">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                            <div class="text-start">
                                <div class="fw-semibold">{{ $user->name }}</div>
                                <small class="text-muted">ID: #{{ $user->id }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        @if($user->is_active)
                            <p class="small fw-medium mb-1">Are you sure you want to deactivate this user?</p>
                            <p class="small text-muted mb-0">They will not be able to log in until reactivated.</p>
                        @else
                            <p class="small fw-medium mb-1">Are you sure you want to activate this user?</p>
                            <p class="small text-muted mb-0">They will be able to log in immediately.</p>
                        @endif
                    </div>

                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-sm btn-light px-4" data-bs-dismiss="modal">
                            <i class="bi bi-x me-1"></i> Cancel
                        </button>
                        <form action="{{ route('admin.users.status', $user) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm px-4 {{ $user->is_active ? 'btn-warning' : 'btn-success' }} text-white">
                                <i class="bi bi-{{ $user->is_active ? 'slash-circle' : 'check-circle' }} me-1"></i>
                                Yes, {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    @if(auth()->user()->hasPermission('delete_users') && auth()->id() !== $user->id)
        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0 shadow">
                    <div class="modal-body p-4 text-center position-relative">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>

                        <div class="d-flex justify-content-center mb-3">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center p-3 bg-danger bg-opacity-10"
                                 style="width: 64px; height: 64px;">
                                <i class="bi bi-trash3 text-danger fs-3"></i>
                            </div>
                        </div>

                        <h5 class="fw-bold text-danger mb-1">Delete User</h5>
                        <p class="small text-muted mb-3">This action cannot be undone</p>

                        <div class="bg-light rounded-3 p-3 mb-3 text-start">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="rounded-circle bg-white d-flex align-items-center justify-content-center shadow-sm"
                                     style="width: 40px; height: 40px;">
                                    <span class="fw-bold text-primary">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                                <div class="text-start">
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                    <small class="text-muted">ID: #{{ $user->id }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="small fw-medium text-danger mb-1">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                Are you sure you want to delete this user?
                            </p>
                            <p class="small text-muted mb-0">
                                This will permanently delete <strong>{{ $user->name }}</strong>'s account
                                and all associated data.
                            </p>
                        </div>

                        <div class="d-flex gap-2 justify-content-center">
                            <button type="button" class="btn btn-sm btn-light px-4" data-bs-dismiss="modal">
                                <i class="bi bi-x me-1"></i> Cancel
                            </button>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger px-4">
                                    <i class="bi bi-trash me-1"></i> Yes, Delete
                                </button>
                            </form>
                        </div>

                        <p class="text-muted small mt-3 mb-0">
                            <i class="bi bi-lock me-1"></i> This action is irreversible
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('styles')
    <style>
        /* Profile specific styles */
        .bg-gradient-primary {
            background: linear-gradient(145deg, #0d6efd, #0b5ed7);
        }

        .info-card {
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .info-card:hover {
            border-color: rgba(13, 110, 253, 0.2);
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .info-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .nav-tabs-light .nav-link {
            border: none;
            color: #6c757d;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .nav-tabs-light .nav-link:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
        }

        .nav-tabs-light .nav-link.active {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        .nav-tabs-light .nav-link i {
            font-size: 0.875rem;
        }

        .card {
            border-radius: 0.75rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .rounded-circle[style*="width: 80px"] {
                width: 60px !important;
                height: 60px !important;
            }

            .fs-2 {
                font-size: 1.5rem !important;
            }

            .nav-tabs-light {
                flex-wrap: nowrap;
                overflow-x: auto;
                padding-bottom: 0.25rem;
            }

            .nav-tabs-light .nav-item {
                flex-shrink: 0;
            }
        }
    </style>
@endpush
