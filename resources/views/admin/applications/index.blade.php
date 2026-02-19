@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">

        <!-- Header with Gradient and Stats -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #1e2b6f 0%, #2b3a8a 50%, #3a4a9f 100%);">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 rounded-3 p-3 me-3 d-none d-md-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-files text-white" viewBox="0 0 16 16">
                                            <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="fw-bold text-white mb-1">{{ ucfirst($status ?? 'All') }} Applications</h2>
                                        <p class="text-white-50 mb-0">Manage and review all application submissions</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <div class="bg-white bg-opacity-10 rounded-3 p-3 d-inline-block">
                                    <span class="text-white me-2">Total:</span>
                                    <span class="h4 fw-bold text-white mb-0">{{ $applications->total() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Filters Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('admin.applications.index', 'all') }}"
                                   class="btn {{ ($status == 'all' || !$status) ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4">
                                    <i class="bi bi-grid-3x3-gap-fill me-2"></i>All
                                </a>

                                <a href="{{ route('admin.applications.pending', 'pending') }}"
                                   class="btn {{ $status == 'pending' ? 'btn-warning' : 'btn-outline-warning' }} rounded-pill px-4">
                                    <i class="bi bi-clock-history me-2"></i>Pending
                                </a>

                                <a href="{{ route('admin.applications.approved', 'approved') }}"
                                   class="btn {{ $status == 'approved' ? 'btn-success' : 'btn-outline-success' }} rounded-pill px-4">
                                    <i class="bi bi-check-circle me-2"></i>Approved
                                </a>

                                <a href="{{ route('admin.applications.reject', 'rejected') }}"
                                   class="btn {{ $status == 'rejected' ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4">
                                    <i class="bi bi-x-circle me-2"></i>Rejected
                                </a>
                            </div>

                            <!-- Per Page Selector -->
                            <form method="GET" class="d-flex align-items-center gap-2">
                                <label class="text-muted small fw-semibold">Show:</label>
                                <select name="per_page" class="form-select form-select-sm w-auto border-0 bg-light" onchange="this.form.submit()" style="min-width: 80px;">
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applications Table Card -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white border-0 py-3 px-4">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <h5 class="fw-semibold mb-0">
                                <i class="bi bi-table text-primary me-2"></i>
                                Applications List
                            </h5>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                    <i class="bi bi-files me-1"></i> {{ $applications->count() }} of {{ $applications->total() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <!-- Desktop Table View -->
                        <div class="d-none d-md-block">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">#</th>
                                    <th>Application ID</th>
                                    <th>Unique ID</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($applications as $app)
                                    <tr>
                                        <td class="ps-4 fw-medium">{{ $applications->firstItem() + $loop->index }}</td>
                                        <td>
                                            <span class="fw-semibold">#{{ $app->id }}</span>
                                        </td>
                                        <td>
                                            <code class="bg-light p-1 rounded">{{ $app->unique_id }}</code>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-2 p-1 me-2">
                                                    <i class="bi bi-person text-primary"></i>
                                                </div>
                                                {{ $app->user->name ?? '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($app->status == 'pending')
                                                <span class="badge bg-warning bg-opacity-25 text-warning px-3 py-2 rounded-pill">
                                                    <span class="dot bg-warning me-1"></span> Pending
                                                </span>
                                            @elseif($app->status == 'approved')
                                                <span class="badge bg-success bg-opacity-25 text-success px-3 py-2 rounded-pill">
                                                    <span class="dot bg-success me-1"></span> Approved
                                                </span>
                                            @elseif($app->status == 'rejected')
                                                <span class="badge bg-danger bg-opacity-25 text-danger px-3 py-2 rounded-pill">
                                                    <span class="dot bg-danger me-1"></span> Rejected
                                                </span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-25 text-secondary px-3 py-2 rounded-pill">
                                                    {{ ucfirst($app->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.applications.show', $app->id) }}"
                                               class="btn btn-primary btn-sm rounded-pill px-4">
                                                <i class="bi bi-eye me-1"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="empty-state">
                                                <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                                                    <i class="bi bi-folder-x fs-1 text-muted"></i>
                                                </div>
                                                <h5 class="fw-semibold mb-2">No Applications Found</h5>
                                                <p class="text-muted mb-0">There are no {{ $status ?? '' }} applications to display.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="d-md-none p-3">
                            @forelse($applications as $app)
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <span class="badge bg-light text-dark me-2">#{{ $app->id }}</span>
                                                <code class="bg-light p-1 rounded small">{{ $app->unique_id }}</code>
                                            </div>
                                            <span class="text-muted small">#{{ $applications->firstItem() + $loop->index }}</span>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-2">
                                                <i class="bi bi-person text-primary"></i>
                                            </div>
                                            <span class="fw-medium">{{ $app->user->name ?? '-' }}</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            @if($app->status == 'pending')
                                                <span class="badge bg-warning px-3 py-2 rounded-pill">
                                                    <span class="dot bg-warning me-1"></span> Pending
                                                </span>
                                            @elseif($app->status == 'approved')
                                                <span class="badge bg-success px-3 py-2 rounded-pill">
                                                    <span class="dot bg-success me-1"></span> Approved
                                                </span>
                                            @elseif($app->status == 'rejected')
                                                <span class="badge bg-danger px-3 py-2 rounded-pill">
                                                    <span class="dot bg-danger me-1"></span> Rejected
                                                </span>
                                            @else
                                                <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                                    {{ ucfirst($app->status) }}
                                                </span>
                                            @endif

                                            <a href="{{ route('admin.applications.show', $app->id) }}"
                                               class="btn btn-primary btn-sm rounded-pill px-4">
                                                <i class="bi bi-eye me-1"></i> View
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body text-center py-5">
                                        <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                                            <i class="bi bi-folder-x fs-1 text-muted"></i>
                                        </div>
                                        <h5 class="fw-semibold mb-2">No Applications Found</h5>
                                        <p class="text-muted mb-0">There are no {{ $status ?? '' }} applications to display.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Pagination Footer -->
                    @if($applications->hasPages() || $applications->total() > 0)
                        <div class="card-footer bg-white border-0 py-3 px-4">
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                                <div class="text-muted small">
                                    Showing <span class="fw-semibold">{{ $applications->firstItem() ?? 0 }}</span>
                                    to <span class="fw-semibold">{{ $applications->lastItem() ?? 0 }}</span>
                                    of <span class="fw-semibold">{{ $applications->total() }}</span> applications
                                </div>
                                <div class="pagination-container">
                                    {{ $applications->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .bg-opacity-20 {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .bg-opacity-10 {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .bg-opacity-25 {
            background-color: rgba(255, 255, 255, 0.25);
        }

        .text-white-50 {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 4px;
        }

        .empty-state {
            padding: 40px 20px;
        }

        .empty-state .rounded-circle {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        /* Table styles */
        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #4a5568;
            border-bottom-width: 2px;
        }

        .table td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
        }

        /* Pagination styling */
        .pagination-container .pagination {
            margin-bottom: 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-container .page-link {
            border-radius: 50px !important;
            margin: 0 3px;
            border: none;
            color: #2d3748;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .pagination-container .page-link:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
        }

        .pagination-container .page-item.active .page-link {
            background: linear-gradient(135deg, #1e2b6f, #2b3a8a);
            color: white;
            box-shadow: 0 4px 10px rgba(30, 43, 111, 0.3);
        }

        .pagination-container .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #f8f9fa;
        }

        /* Card hover effects */
        .card {
            transition: all 0.3s ease;
            border-radius: 20px !important;
        }

        .card:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1) !important;
        }

        /* Button styles */
        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e2b6f, #2b3a8a);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2b3a8a, #1e2b6f);
        }

        /* Filter buttons */
        .btn-outline-primary {
            border-color: #dee2e6;
        }

        .btn-outline-warning,
        .btn-outline-success,
        .btn-outline-danger {
            border-color: #dee2e6;
        }

        /* Form select */
        .form-select {
            border-radius: 50px;
            padding: 0.5rem 2rem 0.5rem 1rem;
            cursor: pointer;
        }

        .form-select:focus {
            box-shadow: none;
            border-color: #1e2b6f;
        }

        /* Mobile optimizations */
        @media (max-width: 767.98px) {
            .container-fluid {
                padding-left: 12px;
                padding-right: 12px;
            }

            .btn {
                padding: 0.4rem 1rem;
                font-size: 0.875rem;
            }

            .badge {
                font-size: 0.75rem;
                padding: 0.4rem 0.8rem;
            }

            .pagination-container .page-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.875rem;
            }
        }

        @media (max-width: 575.98px) {
            .pagination-container .page-link {
                padding: 0.3rem 0.6rem;
                margin: 2px;
            }

            .d-flex.gap-2 {
                gap: 0.5rem !important;
            }

            .btn.rounded-pill {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        /* Animation for empty state */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .empty-state .rounded-circle {
            animation: float 3s ease-in-out infinite;
        }

        /* Hover effect for table rows */
        .table-hover tbody tr:hover {
            background-color: rgba(30, 43, 111, 0.02);
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        /* Code styling */
        code {
            font-size: 0.875rem;
            background-color: #f8f9fa;
            padding: 0.2rem 0.4rem;
            border-radius: 6px;
        }

        /* Status badge enhancements */
        .badge.rounded-pill {
            font-weight: 500;
            font-size: 0.75rem;
        }

        /* Per page selector */
        .form-select-sm {
            border-radius: 50px;
            font-size: 0.875rem;
        }

        /* Header gradient enhancement */
        .bg-opacity-20 {
            backdrop-filter: blur(5px);
        }
    </style>
@endsection
