@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')
    <!-- Dashboard Header -->
    <div class="dashboard-header mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-primary bg-opacity-10 text-primary me-3">
                                        <i class="bi bi-person-circle fs-2"></i>
                                    </div>
                                    <div>
                                        <h1 class="h3 fw-bold mb-1">Welcome, {{ auth()->user()->name }}!</h1>
                                        <p class="text-muted mb-0">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ now()->format('l, F j, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                                <div class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-pill">
                                    <i class="bi bi-shield-check me-1"></i>
                                    Role: <span class="fw-medium">{{ auth()->user()->role->name ?? 'User' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="stat-icon bg-info bg-opacity-10 text-info mx-auto mb-3">
                        <i class="bi bi-folder fs-3"></i>
                    </div>
                    <h3 class="stat-number mb-1">{{ $uploadedCount ?? 0 }}</h3>
                    <p class="stat-label text-muted mb-2">Uploaded Documents</p>
{{--                    @if(auth()->user()->hasPermission('upload_documents'))--}}
{{--                        <a href="{{ route('user.documents.upload') }}" class="btn btn-sm btn-outline-info">--}}
{{--                            Upload Now--}}
{{--                        </a>--}}
{{--                    @endif--}}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning mx-auto mb-3">
                        <i class="bi bi-clock fs-3"></i>
                    </div>
                    <h3 class="stat-number mb-1">{{ $pendingCount ?? 0 }}</h3>
                    <p class="stat-label text-muted mb-2">Pending Review</p>
{{--                    <a href="{{ route('user.documents') }}" class="btn btn-sm btn-outline-warning">--}}
{{--                        View All--}}
{{--                    </a>--}}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="stat-icon bg-success bg-opacity-10 text-success mx-auto mb-3">
                        <i class="bi bi-check-circle fs-3"></i>
                    </div>
                    <h3 class="stat-number mb-1">{{ $approvedCount ?? 0 }}</h3>
                    <p class="stat-label text-muted mb-2">Approved</p>
                    <button class="btn btn-sm btn-outline-success" disabled>
                        View Details
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-3">
                        <i class="bi bi-file-earmark-text fs-3"></i>
                    </div>
                    <h3 class="stat-number mb-1">{{ count($attachments) }}</h3>
                    <p class="stat-label text-muted mb-2">Available Forms</p>
                    <a href="#available-forms" class="btn btn-sm btn-outline-primary">
                        View Forms
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Workflow -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clipboard-check text-primary me-2"></i>
                        Application Workflow
                    </h5>
                </div>
                <div class="card-body">
                    <div class="steps">
                        <div class="step completed">
                            <div class="step-icon">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <div class="step-content">
                                <h6 class="mb-1">Registration</h6>
                                <small class="text-muted">Account Created</small>
                            </div>
                        </div>
                        <div class="step {{ $uploadedCount > 0 ? 'active' : '' }}">
                            <div class="step-icon">
                                <i class="bi bi-cloud-upload"></i>
                            </div>
                            <div class="step-content">
                                <h6 class="mb-1">Document Upload</h6>
                                <small class="text-muted">
                                    {{ $uploadedCount > 0 ? 'Documents uploaded' : 'Pending' }}
                                </small>
                            </div>
                        </div>
                        <div class="step {{ $approvedCount > 0 ? 'active' : '' }}">
                            <div class="step-icon">
                                <i class="bi bi-file-check"></i>
                            </div>
                            <div class="step-content">
                                <h6 class="mb-1">Review</h6>
                                <small class="text-muted">
                                    {{ $approvedCount > 0 ? 'Under review' : 'Awaiting approval' }}
                                </small>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-icon">
                                <i class="bi bi-credit-card"></i>
                            </div>
                            <div class="step-content">
                                <h6 class="mb-1">Payment</h6>
                                <small class="text-muted">Payment verification</small>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="step-content">
                                <h6 class="mb-1">Complete</h6>
                                <small class="text-muted">Application approved</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Forms & Recent Activity -->
    <div class="row g-4">
        <!-- Available Forms -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" id="available-forms">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-file-earmark-text text-info me-2"></i>
                            Available Forms & Documents
                        </h5>
                        <span class="badge bg-info">{{ count($attachments) }} files</span>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($attachments) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th>Document Name</th>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attachments as $attachment)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi {{ $attachment->file_icon }} fs-4 text-{{ $attachment->file_color }} me-2"></i>
                                                <div>
                                                    <div class="fw-medium">{{ $attachment->original_name }}</div>
                                                    <small class="text-muted">Uploaded: {{ $attachment->created_at->format('M d, Y') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                {{ strtoupper(pathinfo($attachment->original_name, PATHINFO_EXTENSION)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $attachment->formatted_size }}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('user.view', $attachment->id) }}"
                                                   class="btn btn-outline-primary"
                                                   title="View"
                                                   target="_blank">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('user.download', $attachment->id) }}"
                                                   class="btn btn-outline-success"
                                                   title="Download">
                                                    <i class="bi bi-download"></i>
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
                            <i class="bi bi-folder-x text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3">No forms available at the moment</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-lightning text-warning me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if(auth()->user()->hasPermission('upload_documents'))
                            <a href="{{ route('user.documents.upload') }}" class="btn btn-primary text-start py-2">
                                <i class="bi bi-cloud-upload me-2"></i>
                                Upload Documents
                            </a>
                        @endif

                        <a href="{{ route('user.documents') }}" class="btn btn-outline-info text-start py-2">
                            <i class="bi bi-folder me-2"></i>
                            My Documents
                        </a>

                        <a href="{{ route('user.application.status') }}" class="btn btn-outline-warning text-start py-2">
                            <i class="bi bi-clock-history me-2"></i>
                            Check Status
                        </a>

                        <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary text-start py-2">
                            <i class="bi bi-person me-2"></i>
                            Update Profile
                        </a>

                        @if(auth()->user()->hasPermission('track_application'))
                            <a href="{{ route('user.application.track') }}" class="btn btn-outline-success text-start py-2">
                                <i class="bi bi-geo-alt me-2"></i>
                                Track Application
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Uploads -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clock-history text-primary me-2"></i>
                        Recent Uploads
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($userDocuments) > 0)
                        <div class="list-group list-group-flush">
                            @foreach($userDocuments->take(3) as $document)
                                <div class="list-group-item border-0 px-0 py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-file-earmark-text text-{{ $document->status_color }} fs-4"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-0">{{ Str::limit($document->original_name, 20) }}</h6>
                                                <span class="badge bg-{{ $document->status_color }}">
                                            {{ ucfirst($document->status) }}
                                        </span>
                                            </div>
                                            <small class="text-muted">{{ $document->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if(count($userDocuments) > 3)
                            <div class="text-center mt-3">
                                <a href="{{ route('user.documents') }}" class="btn btn-sm btn-outline-primary">
                                    View All Uploads
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-3">
                            <i class="bi bi-upload text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2 mb-0">No documents uploaded yet</p>
                            @if(auth()->user()->hasPermission('upload_documents'))
                                <a href="{{ route('user.documents.upload') }}" class="btn btn-sm btn-primary mt-2">
                                    Upload First Document
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Steps Progress */
        .steps {
            display: flex;
            justify-content: space-between;
            position: relative;
        }
        .steps::before {
            content: '';
            position: absolute;
            top: 24px;
            left: 10%;
            right: 10%;
            height: 2px;
            background: #e9ecef;
            z-index: 1;
        }
        .step {
            position: relative;
            z-index: 2;
            text-align: center;
            flex: 1;
        }
        .step-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 1.2rem;
        }
        .step.completed .step-icon {
            background: #198754;
            color: white;
        }
        .step.active .step-icon {
            background: #0d6efd;
            color: white;
            animation: pulse 2s infinite;
        }
        .step-content h6 {
            font-size: 0.9rem;
        }

        /* Animation */
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(13, 110, 253, 0); }
            100% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0); }
        }

        /* Stat Cards */
        .stat-card {
            border-radius: 12px;
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Avatar Circle */
        .avatar-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Status Colors */
        .bg-pending { background-color: #ffc107; }
        .bg-approved { background-color: #198754; }
        .bg-rejected { background-color: #dc3545; }
        .bg-under-review { background-color: #0dcaf0; }
    </style>
@endsection
