@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')
    <!-- Dashboard Header -->
    <div class="dashboard-header mb-3 mb-md-4">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-3 p-md-4">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-8">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-primary bg-opacity-10 text-primary me-2 me-md-3">
                                        <i class="bi bi-person-circle fs-3 fs-md-2"></i>
                                    </div>
                                    <div>
                                        <h1 class="h5 h4-md fw-bold mb-1">Welcome, {{ auth()->user()->name }}!</h1>
                                        <p class="text-muted mb-0 small">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ now()->format('l, F j, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 text-lg-end mt-2 mt-lg-0">
                                <div class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-pill d-inline-flex align-items-center">
                                    <i class="bi bi-shield-check me-1"></i>
                                    <span class="small">Role: <span class="fw-medium">{{ auth()->user()->role->name ?? 'User' }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-2 g-md-3 g-lg-4 mb-3 mb-md-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center p-2 p-md-3">
                    <div class="stat-icon bg-info bg-opacity-10 text-info mx-auto mb-2 mb-md-3 p-2 p-md-3">
                        <i class="bi bi-folder fs-5 fs-md-4 fs-lg-3"></i>
                    </div>
                    <h3 class="stat-number mb-0 fs-5 fs-md-4">{{ $uploadedCount ?? 0 }}</h3>
                    <p class="stat-label text-muted mb-2 small">Uploaded Documents</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center p-2 p-md-3">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning mx-auto mb-2 mb-md-3 p-2 p-md-3">
                        <i class="bi bi-clock fs-5 fs-md-4 fs-lg-3"></i>
                    </div>
                    <h3 class="stat-number mb-0 fs-5 fs-md-4">{{ $pendingCount ?? 0 }}</h3>
                    <p class="stat-label text-muted mb-2 small">Pending Review</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center p-2 p-md-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success mx-auto mb-2 mb-md-3 p-2 p-md-3">
                        <i class="bi bi-check-circle fs-5 fs-md-4 fs-lg-3"></i>
                    </div>
                    <h3 class="stat-number mb-0 fs-5 fs-md-4">{{ $approvedCount ?? 0 }}</h3>
                    <p class="stat-label text-muted mb-2 small">Approved</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center p-2 p-md-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-2 mb-md-3 p-2 p-md-3">
                        <i class="bi bi-file-earmark-text fs-5 fs-md-4 fs-lg-3"></i>
                    </div>
                    <h3 class="stat-number mb-0 fs-5 fs-md-4">{{ count($attachments) }}</h3>
                    <p class="stat-label text-muted mb-2 small">Available Forms</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Workflow -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3 pt-md-4 pb-2 px-3 px-md-4">
                    <h5 class="card-title mb-0 fs-6 fs-md-5">
                        <i class="bi bi-clipboard-check text-primary me-2"></i>
                        Application Workflow
                    </h5>
                </div>
                <div class="card-body p-3 p-md-4">
                    <div class="steps-container">
                        <div class="steps">
                            <div class="step {{ $uploadedCount > 0 ? 'completed' : '' }}">
                                <div class="step-icon">
                                    <i class="bi bi-person-check"></i>
                                </div>
                                <div class="step-content d-none d-sm-block">
                                    <h6 class="mb-1 small">Registration</h6>
                                    <small class="text-muted small">Account Created</small>
                                </div>
                            </div>
                            <div class="step {{ $uploadedCount > 0 ? 'active' : '' }}">
                                <div class="step-icon">
                                    <i class="bi bi-cloud-upload"></i>
                                </div>
                                <div class="step-content d-none d-sm-block">
                                    <h6 class="mb-1 small">Document Upload</h6>
                                    <small class="text-muted small">
                                        {{ $uploadedCount > 0 ? 'Uploaded' : 'Pending' }}
                                    </small>
                                </div>
                            </div>
                            <div class="step {{ $approvedCount > 0 ? 'active' : '' }}">
                                <div class="step-icon">
                                    <i class="bi bi-file-check"></i>
                                </div>
                                <div class="step-content d-none d-sm-block">
                                    <h6 class="mb-1 small">Review</h6>
                                    <small class="text-muted small">
                                        {{ $approvedCount > 0 ? 'Under review' : 'Awaiting' }}
                                    </small>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-icon">
                                    <i class="bi bi-credit-card"></i>
                                </div>
                                <div class="step-content d-none d-sm-block">
                                    <h6 class="mb-1 small">Payment</h6>
                                    <small class="text-muted small">Verification</small>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-icon">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="step-content d-none d-sm-block">
                                    <h6 class="mb-1 small">Complete</h6>
                                    <small class="text-muted small">Approved</small>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Step Labels -->
                        <div class="row mt-3 d-sm-none">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <span class="badge bg-success bg-opacity-10 text-success">Registration ✓</span>
                                    <span class="badge {{ $uploadedCount > 0 ? 'bg-primary text-white' : 'bg-secondary bg-opacity-10 text-secondary' }}">
                                        Upload {{ $uploadedCount > 0 ? '✓' : '' }}
                                    </span>
                                    <span class="badge {{ $approvedCount > 0 ? 'bg-primary text-white' : 'bg-secondary bg-opacity-10 text-secondary' }}">
                                        Review {{ $approvedCount > 0 ? '⋯' : '' }}
                                    </span>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Payment</span>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Done</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Forms & Recent Activity -->
    <div class="row g-3 g-md-4">
        <!-- Available Forms -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100" id="available-forms">
                <div class="card-header bg-white border-0 pt-3 pt-md-4 pb-2 px-3 px-md-4 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                    <h5 class="card-title mb-0 fs-6 fs-md-5">
                        <i class="bi bi-file-earmark-text text-info me-2"></i>
                        Available Forms & Documents
                    </h5>
                    <span class="badge bg-info">{{ count($attachments) }} files</span>
                </div>
                <div class="card-body p-2 p-md-3">
                    @if(count($attachments) > 0)
                        <!-- Desktop Table View -->
                        <div class="table-responsive d-none d-md-block">
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
                                                    <div class="fw-medium">{{ Str::limit($attachment->original_name, 30) }}</div>
                                                    <small class="text-muted">Uploaded: {{ $attachment->created_at->format('M d, Y') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                {{ strtoupper(pathinfo($attachment->original_name, PATHINFO_EXTENSION) ?: 'N/A') }}
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

                        <!-- Mobile Card View -->
                        <div class="d-block d-md-none">
                            @foreach($attachments as $attachment)
                                <div class="card border-0 bg-light mb-2">
                                    <div class="card-body p-2">
                                        <div class="d-flex align-items-start mb-2">
                                            <i class="bi {{ $attachment->file_icon }} fs-3 text-{{ $attachment->file_color }} me-2"></i>
                                            <div class="flex-grow-1">
                                                <div class="fw-medium small">{{ Str::limit($attachment->original_name, 35) }}</div>
                                                <small class="text-muted d-block">
                                                    {{ $attachment->formatted_size }} • {{ $attachment->created_at->format('M d, Y') }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('user.view', $attachment->id) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               target="_blank">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ route('user.download', $attachment->id) }}"
                                               class="btn btn-sm btn-outline-success">
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 py-md-5">
                            <i class="bi bi-folder-x text-muted fs-1"></i>
                            <p class="text-muted mt-2 mb-0 small">No forms available at the moment</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions & Recent Uploads -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm mb-3 mb-md-4">
                <div class="card-header bg-white border-0 pt-3 pt-md-4 pb-2 px-3 px-md-4">
                    <h5 class="card-title mb-0 fs-6 fs-md-5">
                        <i class="bi bi-lightning text-warning me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body p-2 p-md-3">
                    <div class="d-grid gap-2">
                        @if(auth()->user()->hasPermission('upload_documents'))
                            <a href="{{ route('user.documents.upload') }}" class="btn btn-primary text-start py-2 px-3">
                                <i class="bi bi-cloud-upload me-2"></i>
                                Upload Documents
                            </a>
                        @endif

                        <a href="{{ route('user.documents') }}" class="btn btn-outline-info text-start py-2 px-3">
                            <i class="bi bi-folder me-2"></i>
                            My Documents
                        </a>

                        <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary text-start py-2 px-3">
                            <i class="bi bi-person me-2"></i>
                            Update Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Uploads -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3 pt-md-4 pb-2 px-3 px-md-4">
                    <h5 class="card-title mb-0 fs-6 fs-md-5">
                        <i class="bi bi-clock-history text-primary me-2"></i>
                        Recent Uploads
                    </h5>
                </div>
                <div class="card-body p-2 p-md-3">
                    @if(count($userDocuments) > 0)
                        <div class="list-group list-group-flush">
                            @foreach($userDocuments->take(3) as $document)
                                <div class="list-group-item border-0 px-0 py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-file-earmark-text fs-4 text-{{ $document->status_color ?? 'secondary' }}"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-2 ms-md-3">
                                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-1">
                                                <h6 class="mb-0 small">{{ Str::limit($document->original_name, 18) }}</h6>
                                                <span class="badge bg-{{ $document->status_color ?? 'secondary' }} bg-opacity-10 text-{{ $document->status_color ?? 'secondary' }}">
                                                    {{ ucfirst($document->status ?? 'Pending') }}
                                                </span>
                                            </div>
                                            <small class="text-muted d-block mt-1">{{ $document->created_at->diffForHumans() }}</small>
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
                            <i class="bi bi-upload text-muted fs-2"></i>
                            <p class="text-muted mt-2 mb-0 small">No documents uploaded yet</p>
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
        .steps-container {
            overflow-x: auto;
            padding-bottom: 5px;
        }

        .steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            min-width: max-content;
            width: 100%;
            gap: 5px;
        }

        @media (min-width: 576px) {
            .steps {
                min-width: auto;
                gap: 0;
            }
        }

        .steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 8%;
            right: 8%;
            height: 2px;
            background: #e9ecef;
            z-index: 1;
        }

        @media (min-width: 768px) {
            .steps::before {
                top: 24px;
            }
        }

        .step {
            position: relative;
            z-index: 2;
            text-align: center;
            flex: 1;
        }

        .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            font-size: 1rem;
        }

        @media (min-width: 768px) {
            .step-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
        }

        .step.completed .step-icon {
            background: #198754;
            color: white;
        }

        .step.active .step-icon {
            background: #0d6efd;
            color: white;
        }

        .step-content h6 {
            font-size: 0.8rem;
        }

        @media (min-width: 768px) {
            .step-content h6 {
                font-size: 0.9rem;
            }
        }

        /* Stat Cards */
        .stat-card {
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .stat-icon {
                width: 60px;
                height: 60px;
                border-radius: 12px;
            }
        }

        .stat-number {
            font-weight: 700;
            color: #2d3748;
        }

        /* Avatar Circle */
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .avatar-circle {
                width: 48px;
                height: 48px;
            }
        }

        /* Mobile Optimizations */
        @media (max-width: 575.98px) {
            .stat-icon {
                width: 40px;
                height: 40px;
            }

            .stat-icon i {
                font-size: 1.2rem !important;
            }

            .btn-group-sm .btn {
                padding: 0.25rem 0.5rem;
            }

            .badge {
                font-size: 0.65rem;
            }

            .card-body {
                padding: 0.75rem;
            }
        }

        /* Animation */
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4); }
            70% { box-shadow: 0 0 0 8px rgba(13, 110, 253, 0); }
            100% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0); }
        }

        .step.active .step-icon {
            animation: pulse 2s infinite;
        }

        /* Card hover effect */
        .card {
            transition: all 0.2s ease;
        }

        /* Custom scrollbar for steps */
        .steps-container::-webkit-scrollbar {
            height: 4px;
        }

        .steps-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .steps-container::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }

        .steps-container::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
    </style>
@endsection
