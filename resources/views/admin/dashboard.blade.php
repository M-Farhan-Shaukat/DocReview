@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- Welcome Header -->
    <div class="dashboard-header mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="card-body p-4 p-lg-5">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-container me-3">
                                        <div class="avatar-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-shield-check fs-3"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="h2 mb-1 fw-bold text-dark">Welcome back, {{ auth()->user()->name }}!</h1>
                                        <p class="text-muted mb-0">
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
                            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                                <div class="stats-card bg-white bg-opacity-25 p-3 rounded-3 d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-white bg-opacity-25 me-3">
                                            <i class="bi bi-clock text-white"></i>
                                        </div>
                                        <div class="text-white">
                                            <small class="d-block opacity-75">System Uptime</small>
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
    <div class="row g-4 mb-4">
        <!-- Total Files -->
        <div class="col-xl-3 col-lg-6">
            <div class="card stat-card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon bg-primary bg-opacity-10">
                            <i class="bi bi-folder text-primary"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0 border-0" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.attachments') }}">View All</a></li>
                            </ul>
                        </div>
                    </div>
                    <h3 class="stat-number mb-1">{{ $totalFiles }}</h3>
                    <p class="stat-label text-muted mb-0">Total Files</p>
                    <div class="stat-trend mt-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-arrow-up me-1"></i> Active: {{ $activeFiles }}
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Files -->
        <div class="col-xl-3 col-lg-6">
            <div class="card stat-card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon bg-success bg-opacity-10">
                            <i class="bi bi-check-circle text-success"></i>
                        </div>
                    </div>
                    <h3 class="stat-number mb-1">{{ $activeFiles }}</h3>
                    <p class="stat-label text-muted mb-0">Active Files</p>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-success"
                             style="width: {{ $totalFiles > 0 ? ($activeFiles / $totalFiles) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Storage Used -->
        <div class="col-xl-3 col-lg-6">
            <div class="card stat-card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon bg-warning bg-opacity-10">
                            <i class="bi bi-hdd text-warning"></i>
                        </div>
                    </div>
                    <h3 class="stat-number mb-1">{{ $storageUsedMB }} MB</h3>
                    <p class="stat-label text-muted mb-0">Storage Used</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-muted">Usage</small>
                            <small class="text-muted">{{ round(($storageUsedMB / 1024) * 100, 1) }}% of 1GB</small>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: {{ ($storageUsedMB / 1024) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-xl-3 col-lg-6">
            <div class="card stat-card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon bg-info bg-opacity-10">
                            <i class="bi bi-people text-info"></i>
                        </div>
                        @if(auth()->user()->hasPermission('manage_users'))
                            <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-info">Manage</a>
                        @endif
                    </div>
                    <h3 class="stat-number mb-1">{{ $totalUsers }}</h3>
                    <p class="stat-label text-muted mb-0">Total Users</p>
                    <div class="mt-3">
                        <div class="user-avatars">
                            @foreach($recentUsers->take(3) as $user)
                                <div class="avatar-sm" data-bs-toggle="tooltip" title="{{ $user->name }}">
                                    <div class="avatar-circle bg-light text-dark border">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                </div>
                            @endforeach
                            @if($totalUsers > 3)
                                <div class="avatar-sm">
                                    <div class="avatar-circle bg-light text-dark border">
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
    <div class="row g-4">
        <!-- Recent Files -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-clock-history text-primary me-2"></i>
                            Recent Files
                        </h5>
                        <a href="{{ route('admin.attachments') }}" class="btn btn-sm btn-outline-primary">
                            View All <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($recentFiles->count() > 0)
                        <div class="table-responsive">
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
                                @foreach($recentFiles as $file)
                                    <tr class="hover-row">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="file-icon me-2">
                                                    <i class="bi {{ $file->file_icon }} fs-4 text-{{ $file->file_color }}"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium">{{ Str::limit($file->original_name, 25) }}</div>
                                                    <small class="text-muted">{{ $file->created_at->format('h:i A') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($file->user)
                                                <span class="text-muted">{{ $file->user->name }}</span>
                                            @else
                                                <span class="text-muted">System</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $file->formatted_size }}</span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill bg-{{ $file->is_active ? 'success' : 'secondary' }}-subtle text-{{ $file->is_active ? 'success' : 'secondary' }} border-0">
                                                <i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i>
                                                {{ $file->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $file->created_at->format('M j') }}</small>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.attachments') }}" class="btn btn-outline-primary" title="Manage">
                                                    <i class="bi bi-gear"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state-icon mb-3">
                                <i class="bi bi-folder-x text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-muted mb-2">No files uploaded yet</h5>
                            <p class="text-muted mb-4">Upload your first document</p>
                            <a href="{{ route('admin.attachments') }}" class="btn btn-primary">
                                <i class="bi bi-cloud-upload me-2"></i>
                                Upload Files
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Users & Quick Actions -->
        <div class="col-lg-4">
            <!-- Recent Users -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-people text-info me-2"></i>
                        Recent Users
                    </h5>
                </div>
                <div class="card-body">
                    @if($recentUsers->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentUsers->take(5) as $user)
                                <div class="list-group-item border-0 px-0 py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-circle bg-light text-dark border" style="width: 40px; height: 40px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                                <span class="badge bg-{{ $user->role ? strtolower($user->role->name) : 'secondary' }}">
                                            {{ $user->role ? $user->role->name : 'No Role' }}
                                        </span>
                                            </div>
                                            <small class="text-muted">{{ $user->email }}</small>
                                            <div class="mt-1">
                                                <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="bi bi-people text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2 mb-0">No users found</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-lightning-charge text-warning me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.attachments') }}" class="btn btn-primary text-start py-2">
                            <i class="bi bi-cloud-upload me-2"></i>
                            Upload Files
                        </a>

                        @if(auth()->user()->hasPermission('manage_users'))
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-danger text-start py-2">
                                <i class="bi bi-people me-2"></i>
                                Manage Users
                            </a>
                        @endif

                        @if(auth()->user()->hasPermission('view_reports'))
                            <a href="{{ route('admin.statistics') }}" class="btn btn-outline-info text-start py-2">
                                <i class="bi bi-bar-chart me-2"></i>
                                View Statistics
                            </a>
                        @endif

                        <a href="#" class="btn btn-outline-secondary text-start py-2">
                            <i class="bi bi-gear me-2"></i>
                            System Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users by Role Chart -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pie-chart text-success me-2"></i>
                        Users by Role
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($usersByRole) > 0)
                        <div class="row">
                            @foreach($usersByRole as $roleName => $count)
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="text-center">
                                        <div class="bg-light rounded p-3">
                                            <h4 class="mb-1">{{ $roleName }}</h4>
                                            <div class="progress" style="height: 8px;">
                                                @php
                                                    $percentage = $totalUsers > 0 ? ($count / $totalUsers) * 100 : 0;
                                                    $colorClass = match($roleName) {
                                                        'Admin' => 'bg-danger',
                                                        'Manager' => 'bg-warning',
                                                        'Staff' => 'bg-info',
                                                        'User' => 'bg-primary',
                                                        default => 'bg-secondary'
                                                    };
                                                @endphp
                                                <div class="progress-bar {{ $colorClass }}" style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <small class="text-muted">{{ $count }} users ({{ round($percentage, 1) }}%)</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">No user data available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom CSS for Dashboard */
        .dashboard-header .card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 16px;
        }

        .avatar-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .avatar-sm .avatar-circle {
            width: 32px;
            height: 32px;
            font-size: 0.8rem;
        }

        .stat-card {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
        }

        .user-avatars {
            display: flex;
            gap: 8px;
        }

        .hover-row:hover {
            background-color: #f8f9fa;
        }

        .badge.bg-admin { background-color: #dc3545; }
        .badge.bg-manager { background-color: #ffc107; }
        .badge.bg-staff { background-color: #0dcaf0; }
        .badge.bg-user { background-color: #0d6efd; }
    </style>
@endsection
