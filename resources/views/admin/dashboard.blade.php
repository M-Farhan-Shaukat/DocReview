@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- Welcome Header -->
    <div class="dashboard-header mb-3 mb-md-4">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="card-body p-3 p-lg-4">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-8">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-container me-2 me-md-3">
                                        <div class="avatar-circle bg-primary bg-opacity-10 text-primary p-2">
                                            <i class="bi bi-shield-check fs-4 fs-md-3"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="h5 h4-md h3-lg fw-bold mb-1 text-dark">Welcome, {{ auth()->user()->name }}!</h1>
                                        <p class="text-muted mb-0 small">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ now()->format('l, F j, Y') }}
                                            •
                                            <span class="badge ms-1
                                                @if(auth()->user()->hasRole('Admin')) bg-danger
                                                @elseif(auth()->user()->hasRole('Manager')) bg-warning
                                                @elseif(auth()->user()->hasRole('Staff')) bg-info
                                                @else bg-secondary @endif">
                                                {{ auth()->user()->role->name ?? 'Admin' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 text-lg-end mt-2 mt-lg-0">
                                <div class="stats-card bg-white bg-opacity-25 p-2 rounded-3 d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-white bg-opacity-25 me-2 p-1">
                                            <i class="bi bi-clock text-white small"></i>
                                        </div>
                                        <div class="text-white small">
                                            <small class="d-block opacity-75">System</small>
                                            <strong class="d-block">100%</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-2 g-md-3 g-lg-4 mb-3 mb-md-4">
        <!-- Total Files -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex justify-content-between align-items-start mb-1 mb-md-2">
                        <div class="stat-icon bg-primary bg-opacity-10 p-1 p-md-2">
                            <i class="bi bi-folder text-primary fs-6 fs-md-5"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0 border-0" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical small"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item small" href="{{ route('admin.attachments') }}">View All</a></li>
                            </ul>
                        </div>
                    </div>
                    <h3 class="stat-number mb-0 fs-5 fs-md-4 fs-lg-3">{{ $totalFiles }}</h3>
                    <p class="stat-label text-muted mb-0 small">Total Files</p>
                    <div class="stat-trend mt-1 mt-md-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary small">
                            <i class="bi bi-arrow-up me-1"></i> Active: {{ $activeFiles }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Files -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex justify-content-between align-items-start mb-1 mb-md-2">
                        <div class="stat-icon bg-success bg-opacity-10 p-1 p-md-2">
                            <i class="bi bi-check-circle text-success fs-6 fs-md-5"></i>
                        </div>
                    </div>
                    <h3 class="stat-number mb-0 fs-5 fs-md-4 fs-lg-3">{{ $activeFiles }}</h3>
                    <p class="stat-label text-muted mb-0 small">Active Files</p>
                    <div class="progress mt-1 mt-md-2" style="height: 4px;">
                        <div class="progress-bar bg-success"
                             style="width: {{ $totalFiles > 0 ? ($activeFiles / $totalFiles) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Storage Used -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex justify-content-between align-items-start mb-1 mb-md-2">
                        <div class="stat-icon bg-warning bg-opacity-10 p-1 p-md-2">
                            <i class="bi bi-hdd text-warning fs-6 fs-md-5"></i>
                        </div>
                    </div>
                    <h3 class="stat-number mb-0 fs-5 fs-md-4 fs-lg-3">{{ $storageUsedMB }} MB</h3>
                    <p class="stat-label text-muted mb-0 small">Storage Used</p>
                    <div class="mt-1 mt-md-2">
                        <div class="d-flex justify-content-between mb-0 mb-md-1">
                            <small class="text-muted small">{{ round(($storageUsedMB / 1024) * 100, 1) }}%</small>
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar bg-warning" style="width: {{ ($storageUsedMB / 1024) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex justify-content-between align-items-start mb-1 mb-md-2">
                        <div class="stat-icon bg-info bg-opacity-10 p-1 p-md-2">
                            <i class="bi bi-people text-info fs-6 fs-md-5"></i>
                        </div>
                        @if(auth()->user()->hasPermission('manage_users'))
                            <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-info py-0 px-1 px-md-2">
                                <small>Manage</small>
                            </a>
                        @endif
                    </div>
                    <h3 class="stat-number mb-0 fs-5 fs-md-4 fs-lg-3">{{ $totalUsers }}</h3>
                    <p class="stat-label text-muted mb-0 small">Total Users</p>
                    <div class="mt-1 mt-md-2">
                        <div class="user-avatars d-flex gap-1">
                            @foreach($recentUsers->take(3) as $user)
                                <div class="avatar-sm" data-bs-toggle="tooltip" title="{{ $user->name }}">
                                    <div class="avatar-circle bg-light text-dark border"
                                         style="width: 25px; height: 25px; font-size: 0.7rem;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                </div>
                            @endforeach
                            @if($totalUsers > 3)
                                <div class="avatar-sm">
                                    <div class="avatar-circle bg-light text-dark border"
                                         style="width: 25px; height: 25px; font-size: 0.7rem;">
                                        +{{ $totalUsers - 3 }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Users -->
    <div class="row g-2 g-md-3">
        <!-- Recent Files -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-2 pt-md-3 pb-1 pb-md-2 px-2 px-md-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fs-6 fs-md-5">
                            <i class="bi bi-clock-history text-primary me-2"></i>
                            Recent Files
                        </h5>
                        <a href="{{ route('admin.attachments') }}" class="btn btn-sm btn-outline-primary py-1">
                            <small>View All</small> <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-2 p-md-3">
                    @if($recentFiles->count() > 0)
                        <!-- Desktop Table View -->
                        <div class="table-responsive d-none d-md-block">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th>File Name</th>
                                    <th>Uploaded By</th>
                                    <th>Size</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recentFiles->take(5) as $file)
                                    <tr class="hover-row">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="file-icon me-2">
                                                    <i class="bi {{ $file->file_icon }} text-{{ $file->file_color }}"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium small">{{ Str::limit($file->original_name, 20) }}</div>
                                                    <small class="text-muted">{{ $file->created_at->format('h:i A') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="small">{{ $file->user->name ?? 'System' }}</span></td>
                                        <td><span class="small">{{ $file->formatted_size }}</span></td>
                                        <td>
                                            <span class="badge rounded-pill bg-{{ $file->is_active ? 'success' : 'secondary' }}-subtle text-{{ $file->is_active ? 'success' : 'secondary' }} border-0 small">
                                                {{ $file->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td><small class="text-muted">{{ $file->created_at->format('M j') }}</small></td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.attachments') }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-gear"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="d-block d-md-none">
                            @foreach($recentFiles->take(3) as $file)
                                <div class="bg-light rounded-3 p-2 mb-2">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="bi {{ $file->file_icon }} text-{{ $file->file_color }} me-2 fs-6"></i>
                                        <div class="fw-medium small text-truncate flex-grow-1">{{ $file->original_name }}</div>
                                        <span class="badge bg-{{ $file->is_active ? 'success' : 'secondary' }} bg-opacity-10 text-{{ $file->is_active ? 'success' : 'secondary' }} small">
                                            {{ $file->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="text-muted d-block">{{ $file->user->name ?? 'System' }}</small>
                                            <small class="text-muted">{{ $file->formatted_size }} • {{ $file->created_at->format('M j, h:i A') }}</small>
                                        </div>
                                        <a href="{{ route('admin.attachments') }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-gear"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            @if($recentFiles->count() > 3)
                                <div class="text-center mt-2">
                                    <a href="{{ route('admin.attachments') }}" class="btn btn-sm btn-link text-decoration-none">
                                        View all {{ $recentFiles->count() }} files <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-3 py-md-4">
                            <div class="empty-state-icon mb-2">
                                <i class="bi bi-folder-x text-muted fs-2"></i>
                            </div>
                            <h5 class="text-muted mb-1 small">No files uploaded yet</h5>
                            <p class="text-muted mb-3 small">Upload your first document</p>
                            <a href="{{ route('admin.attachments') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-cloud-upload me-2"></i> Upload Files
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Users & Quick Actions -->
        <div class="col-lg-4">
            <!-- Recent Users -->
            <div class="card border-0 shadow-sm mb-2 mb-md-3">
                <div class="card-header bg-white border-0 pt-2 pt-md-3 pb-1 pb-md-2 px-2 px-md-3">
                    <h5 class="card-title mb-0 fs-6 fs-md-5">
                        <i class="bi bi-people text-info me-2"></i>
                        Recent Users
                    </h5>
                </div>
                <div class="card-body p-2 p-md-3">
                    @if($recentUsers->count() > 0)
                        @foreach($recentUsers->take(3) as $user)
                            <div class="d-flex align-items-center mb-2 pb-1 border-bottom">
                                <div class="flex-shrink-0">
                                    <div class="avatar-circle bg-light text-dark border"
                                         style="width: 35px; height: 35px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 small fw-semibold">{{ $user->name }}</h6>
                                        <span class="badge bg-{{ $user->role ? strtolower($user->role->name) : 'secondary' }} small">
                                            {{ $user->role ? $user->role->name : 'No Role' }}
                                        </span>
                                    </div>
                                    <small class="text-muted d-block small">{{ $user->email }}</small>
                                    <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                        @if($recentUsers->count() > 3)
                            <div class="text-center mt-2">
                                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-link text-decoration-none small">
                                    View all users <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-2">
                            <i class="bi bi-people text-muted fs-4"></i>
                            <p class="text-muted mt-1 mb-0 small">No users found</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-2 pt-md-3 pb-1 pb-md-2 px-2 px-md-3">
                    <h5 class="card-title mb-0 fs-6 fs-md-5">
                        <i class="bi bi-lightning-charge text-warning me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body p-2 p-md-3">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.attachments') }}" class="btn btn-primary text-start py-1 py-md-2">
                            <i class="bi bi-cloud-upload me-2"></i> Upload Files
                        </a>

                        @if(auth()->user()->hasPermission('manage_users'))
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-danger text-start py-1 py-md-2">
                                <i class="bi bi-people me-2"></i> Manage Users
                            </a>
                        @endif

                        @if(auth()->user()->hasPermission('view_reports'))
                            <a href="#" class="btn btn-outline-info text-start py-1 py-md-2">
                                <i class="bi bi-bar-chart me-2"></i> View Statistics
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users by Role Chart -->
    @if(count($usersByRole) > 0)
        <div class="row mt-2 mt-md-3 mt-lg-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pt-2 pt-md-3 pb-1 pb-md-2 px-2 px-md-3">
                        <h5 class="card-title mb-0 fs-6 fs-md-5">
                            <i class="bi bi-pie-chart text-success me-2"></i>
                            Users by Role
                        </h5>
                    </div>
                    <div class="card-body p-2 p-md-3">
                        <div class="row g-2 g-md-3">
                            @foreach($usersByRole as $roleName => $count)
                                <div class="col-6 col-md-3">
                                    <div class="bg-light rounded-3 p-2 p-md-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold small">{{ $roleName }}</span>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                {{ $count }}
                                            </span>
                                        </div>
                                        <div class="progress" style="height: 4px;">
                                            @php
                                                $percentage = $totalUsers > 0 ? ($count / $totalUsers) * 100 : 0;
                                                $colorClass = match($roleName) {
                                                    'Admin' => 'bg-danger',
                                                    'Manager' => 'bg-warning',
                                                    'Staff' => 'bg-info',
                                                    default => 'bg-primary'
                                                };
                                            @endphp
                                            <div class="progress-bar {{ $colorClass }}" style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <small class="text-muted d-block mt-1 small">{{ round($percentage, 1) }}%</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style>
        .dashboard-header .card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
        }
        .stat-card {
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
        }
        .avatar-circle {
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @media (max-width: 767.98px) {
            .stat-number {
                font-size: 1.25rem;
            }
            .dashboard-header .card {
                border-radius: 8px;
            }
        }
    </style>
@endsection
