@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Users</h3>
                <p class="text-muted mb-0">Manage system users and their permissions</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Create User
            </a>
        </div>

        <!-- Filter Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-3">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <form method="GET" action="{{ route('admin.users') }}" id="perPageForm" class="d-flex align-items-center">
                            <label class="text-muted me-2 small">Show:</label>
                            <select name="per_page" onchange="this.form.submit()" class="form-select form-select-sm" style="width: auto;">
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>
                    </div>
                    <div class="col-auto ms-auto">
                        <form method="GET" action="{{ route('admin.users') }}" class="d-flex">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       class="form-control border-start-0"
                                       placeholder="Search users..."
                                       style="min-width: 250px;">
                                @if(request('search'))
                                    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-x"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th class="px-4">Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-end px-4">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="px-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                                         style="width: 32px; height: 32px; background-color: #{{ substr(md5($user->name), 0, 6) }} !important;">
                                        <span class="fw-bold small">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <div class="fw-medium">{{ $user->name }}</div>
                                        @if($user->email_verified_at)
                                            <small class="text-success">
                                                <i class="bi bi-check-circle-fill me-1" style="font-size: 0.75rem;"></i>Verified
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="small">{{ $user->email }}</span>
                            </td>
                            <td>
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">
                                        <i class="bi bi-person-badge me-1"></i>
                                        {{ $user->role->name ?? 'No Role' }}
                                    </span>
                            </td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> Active
                                        </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                            <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> Inactive
                                        </span>
                                @endif
                            </td>
                            <td class="text-end px-4">
                                <!-- View Button -->
                                <a href="{{ route('admin.users.show', $user) }}"
                                   class="btn btn-sm btn-outline-info border-0"
                                   title="View Details"
                                   data-bs-toggle="tooltip">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="btn btn-sm btn-outline-primary border-0"
                                   title="Edit User"
                                   data-bs-toggle="tooltip">
                                    <i class="bi bi-pencil"></i>
                                </a>


                                <button type="button"
                                        class="btn btn-sm btn-outline-danger border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $user->id }}"
                                        title="Delete User">
                                    <i class="bi bi-trash"></i>
                                </button>


                                    {{--Delete Modal--}}
                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-body p-4 text-center position-relative">
                                                <!-- Close Button -->
                                                <button type="button"
                                                        class="btn-close position-absolute top-0 end-0 m-3"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                </button>

                                                <!-- Delete Icon -->
                                                <div class="d-flex justify-content-center mb-3">
                                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center p-3 bg-danger bg-opacity-10"
                                                         style="width: 64px; height: 64px;">
                                                        <i class="bi bi-trash3 text-danger fs-3"></i>
                                                    </div>
                                                </div>

                                                <!-- Modal Title -->
                                                <h5 class="fw-bold text-danger mb-1">
                                                    Delete User
                                                </h5>

                                                <!-- Subtitle -->
                                                <p class="small text-muted mb-3">
                                                    This action cannot be undone
                                                </p>

                                                <!-- User Info Card -->
                                                <div class="bg-light rounded-3 p-3 mb-3 text-start">
                                                    <div class="d-flex align-items-center gap-3 mb-2">
                                                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center shadow-sm"
                                                             style="width: 40px; height: 40px;">
                                <span class="fw-bold text-primary">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                                                        </div>
                                                        <div class="text-start">
                                                            <div class="fw-semibold">{{ $user->name }}</div>
                                                            <small class="text-muted">ID: #{{ $user->id }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="small">
                                                        <div class="d-flex align-items-center gap-2 mb-1">
                                                            <i class="bi bi-envelope text-secondary" style="width: 16px;"></i>
                                                            <span class="text-muted">{{ $user->email }}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2 mb-1">
                                                            <i class="bi bi-shield text-secondary" style="width: 16px;"></i>
                                                            <span class="text-muted">{{ $user->role->name ?? 'No Role' }}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <i class="bi bi-circle-fill text-secondary" style="width: 16px; font-size: 10px;"></i>
                                                            <span class="text-muted">Status:
                                    @if($user->is_active)
                                                                    <span class="badge bg-success bg-opacity-10 text-success px-2 py-1">Active</span>
                                                                @else
                                                                    <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1">Inactive</span>
                                                                @endif
                                </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Warning Message -->
                                                <div class="mb-4">
                                                    <p class="small fw-medium text-danger mb-1">
                                                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                                        Are you sure you want to delete this user?
                                                    </p>
                                                    <p class="small text-muted mb-0">
                                                        This will permanently delete <strong>{{ $user->name }}</strong>'s account
                                                        and all associated data from the system.
                                                    </p>
                                                </div>

                                                <!-- Modal Actions -->
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button type="button"
                                                            class="btn btn-sm btn-light px-4"
                                                            data-bs-dismiss="modal">
                                                        <i class="bi bi-x me-1"></i>
                                                        Cancel
                                                    </button>

                                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger px-4">
                                                            <i class="bi bi-trash me-1"></i>
                                                            Yes, Delete
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Footer Note -->
                                                <p class="text-muted small mt-3 mb-0">
                                                    <i class="bi bi-lock me-1"></i>
                                                    This action is irreversible
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Toggle Status Button -->
                                <button type="button"
                                        class="btn btn-sm {{ $user->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#statusModal{{ $user->id }}"
                                        title="{{ $user->is_active ? 'Deactivate' : 'Activate' }} User">
                                    <i class="bi bi-{{ $user->is_active ? 'slash-circle' : 'check-circle' }}"></i>
                                </button>
{{--                                active toogle modal--}}
                                <div class="modal fade" id="statusModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-body p-4 text-center">
                                                <!-- Close Button -->
                                                <button type="button"
                                                        class="btn-close position-absolute top-0 end-0 m-3"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                        style="z-index: 10;">
                                                </button>

                                                <!-- Status Icon -->
                                                <div class="d-flex justify-content-center mb-3">
                                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center p-3
                        {{ $user->is_active ? 'bg-warning bg-opacity-10' : 'bg-success bg-opacity-10' }}"
                                                         style="width: 64px; height: 64px;">
                                                        <i class="bi bi-{{ $user->is_active ? 'exclamation-triangle' : 'check-circle' }}
                            {{ $user->is_active ? 'text-warning' : 'text-success' }} fs-3"></i>
                                                    </div>
                                                </div>

                                                <!-- Modal Title -->
                                                <h5 class="fw-bold mb-1 {{ $user->is_active ? 'text-warning' : 'text-success' }}">
                                                    {{ $user->is_active ? 'Deactivate' : 'Activate' }} User
                                                </h5>

                                                <!-- Subtitle -->
                                                <p class="small text-muted mb-3">
                                                    {{ $user->is_active ? 'This will revoke system access' : 'This will grant system access' }}
                                                </p>

                                                <!-- User Info Card -->
                                                <div class="bg-light rounded-3 p-3 mb-3 text-start">
                                                    <div class="d-flex align-items-center gap-3 mb-2">
                                                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center shadow-sm"
                                                             style="width: 40px; height: 40px;">
                            <span class="fw-bold text-primary">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                                                        </div>
                                                        <div>
                                                            <div class="fw-semibold">{{ $user->name }}</div>
                                                            <small class="text-muted">ID: #{{ $user->id }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="small">
                                                        <div class="d-flex align-items-center gap-2 mb-1">
                                                            <i class="bi bi-envelope text-secondary" style="width: 16px;"></i>
                                                            <span class="text-muted">{{ $user->email }}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2 mb-1">
                                                            <i class="bi bi-shield text-secondary" style="width: 16px;"></i>
                                                            <span class="text-muted">{{ $user->role->name ?? 'No Role' }}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <i class="bi bi-circle-fill text-secondary" style="width: 16px; font-size: 10px;"></i>
                                                            <span class="text-muted">Current Status:
                                @if($user->is_active)
                                                                    <span class="badge bg-success bg-opacity-10 text-success px-2 py-1">Active</span>
                                                                @else
                                                                    <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1">Inactive</span>
                                                                @endif
                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Confirmation Message -->
                                                <div class="mb-4">
                                                    @if($user->is_active)
                                                        <p class="small fw-medium mb-1">Are you sure you want to deactivate this user?</p>
                                                        <p class="small text-muted mb-0">
                                                            <i class="bi bi-exclamation-circle me-1"></i>
                                                            They will not be able to log in until reactivated.
                                                        </p>
                                                    @else
                                                        <p class="small fw-medium mb-1">Are you sure you want to activate this user?</p>
                                                        <p class="small text-muted mb-0">
                                                            <i class="bi bi-check-circle me-1"></i>
                                                            They will be able to log in immediately.
                                                        </p>
                                                    @endif
                                                </div>

                                                <!-- Modal Actions -->
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button type="button"
                                                            class="btn btn-sm btn-light px-4"
                                                            data-bs-dismiss="modal">
                                                        Cancel
                                                    </button>

                                                    <form action="{{ route('admin.users.status', $user) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="btn btn-sm px-4 {{ $user->is_active ? 'btn-warning' : 'btn-success' }} text-white">
                                                            <i class="bi bi-{{ $user->is_active ? 'slash-circle' : 'check-circle' }} me-1"></i>
                                                            Yes, {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-people fs-1 text-muted mb-3"></i>
                                    <h5 class="fw-normal text-muted mb-3">No users found</h5>
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-lg"></i> Create User
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            <i class="bi bi-list-ul me-1"></i>
                            Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} entries
                        </div>
                        <div>
                            {{ $users->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Custom styles for better UI */
        .table > :not(caption) > * > * {
            padding: 1rem 0.75rem;
            vertical-align: middle;
        }

        .bg-opacity-10 {
            --bs-bg-opacity: 0.1;
        }

        /* Action buttons styling */
        .btn-outline-info.border-0,
        .btn-outline-primary.border-0,
        .btn-outline-warning.border-0 {
            padding: 0.4rem 0.65rem;
            font-size: 0.875rem;
            line-height: 1;
            border: 1px solid transparent !important;
            transition: all 0.2s ease;
            margin: 0 2px;
        }

        .btn-outline-info.border-0:hover {
            background-color: rgba(13, 202, 240, 0.1);
            color: #0dcaf0;
            border-color: rgba(13, 202, 240, 0.2) !important;
        }

        .btn-outline-primary.border-0:hover {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            border-color: rgba(13, 110, 253, 0.2) !important;
        }

        .btn-outline-warning.border-0:hover {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border-color: rgba(255, 193, 7, 0.2) !important;
        }

        .btn-outline-info.border-0 i,
        .btn-outline-primary.border-0 i,
        .btn-outline-warning.border-0 i {
            font-size: 0.875rem;
        }

        .form-select-sm {
            padding-top: 0.35rem;
            padding-bottom: 0.35rem;
            font-size: 0.875rem;
        }

        .badge {
            font-weight: 500;
            font-size: 0.75rem;
        }

        .badge i {
            vertical-align: middle;
        }

        /* Card styling */
        .card {
            border-radius: 0.75rem;
        }

        /* Table header styling */
        .bg-light {
            background-color: #f8f9fa !important;
        }

        /* Hover effect on rows */
        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,.02);
        }

        /* Action buttons container */
        .d-inline-block {
            margin: 0 2px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Enable Bootstrap tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })
    </script>
@endpush
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
                <p class="small mb-0">Are you sure you want to delete?</p>
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
