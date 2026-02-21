@extends('user.layouts.app')

@section('title', 'User Dashboard')

@section('content')
    <!-- Enhanced Dashboard Header with subtle pattern -->
    <div class="dashboard-header mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);">
                    <div class="card-body p-4 p-md-5 position-relative">
                        <!-- Decorative elements -->
                        <div class="position-absolute top-0 end-0 opacity-10 d-none d-md-block">
                            <svg width="180" height="180" viewBox="0 0 100 100" fill="white">
                                <circle cx="80" cy="20" r="20"/>
                                <circle cx="20" cy="80" r="30"/>
                                <circle cx="90" cy="90" r="15"/>
                            </svg>
                        </div>
                        <div class="row align-items-center position-relative">
                            <div class="col-12 col-lg-8">
                                <div class="d-flex align-items-center flex-wrap flex-md-nowrap">
                                    <div class="avatar-circle bg-white shadow-lg me-3 mb-2 mb-md-0" style="width: 70px; height: 70px; border-radius: 20px; transform: rotate(-5deg);">
                                        @php
                                            $colors = ['primary', 'info', 'success', 'warning', 'danger'];
                                            $randomColor = $colors[array_rand($colors)];
                                        @endphp
                                        <i class="bi bi-person-circle fs-1 text-{{ $randomColor }}"></i>
                                    </div>
                                    <div class="text-white">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <h1 class="h3 fw-bold mb-0">Welcome back, {{ auth()->user()->name }}!</h1>
                                            <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm">
                                                <i class="bi bi-shield-check me-1"></i>
                                                {{ auth()->user()->role->name ?? 'User' }}
                                            </span>
                                        </div>
                                        <p class="mb-0 mt-2 opacity-90 d-flex align-items-center flex-wrap">
                                            <i class="bi bi-calendar3 me-2"></i>
                                            {{ now()->format('l, F j, Y') }}
                                            <span class="mx-2 d-none d-sm-inline">•</span>
                                            <i class="bi bi-clock me-2 ms-0 ms-sm-2"></i>
                                            {{ now()->format('h:i A') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 text-lg-end mt-3 mt-lg-0">
                                <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                                    <span class="badge bg-white text-dark p-3 rounded-3 shadow-sm d-inline-flex align-items-center">
                                        <i class="bi bi-cloud-check fs-5 me-2 text-success"></i>
                                        <div class="text-start">
                                            <small class="text-secondary d-block">Documents Uploaded</small>
                                            <span class="fw-bold fs-5">{{ $userDocuments->count() ?? 0 }}</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    @php
        $uploadedCount = $userDocuments->count() ?? 0;
        $pendingCount = $userDocuments->where('status', 'pending')->count() ?? 0;
        $approvedCount = $userDocuments->where('status', 'approved')->count() ?? 0;
        $rejectedCount = $userDocuments->where('status', 'rejected')->count() ?? 0;
        $generalDocsCount = $generalDocuments->count() ?? 0;
    @endphp

{{--
    <div class="row g-3 g-md-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-wrapper bg-primary bg-opacity-10 rounded-3 me-3 p-2 p-md-3">
                            <i class="bi bi-file-earmark-text fs-4 text-primary"></i>
                        </div>
                        <div>
                            <span class="stat-number fw-bold fs-4">{{ $uploadedCount }}</span>
                            <p class="stat-label text-muted small mb-0">Total Uploads</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary small">+{{ $uploadedCount }} files</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-wrapper bg-warning bg-opacity-10 rounded-3 me-3 p-2 p-md-3">
                            <i class="bi bi-clock-history fs-4 text-warning"></i>
                        </div>
                        <div>
                            <span class="stat-number fw-bold fs-4">{{ $pendingCount }}</span>
                            <p class="stat-label text-muted small mb-0">Pending</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-warning bg-opacity-10 text-warning small">Awaiting review</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-wrapper bg-success bg-opacity-10 rounded-3 me-3 p-2 p-md-3">
                            <i class="bi bi-check-circle fs-4 text-success"></i>
                        </div>
                        <div>
                            <span class="stat-number fw-bold fs-4">{{ $approvedCount }}</span>
                            <p class="stat-label text-muted small mb-0">Approved</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-success bg-opacity-10 text-success small">Verified</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-wrapper bg-info bg-opacity-10 rounded-3 me-3 p-2 p-md-3">
                            <i class="bi bi-grid-3x3-gap-fill fs-4 text-info"></i>
                        </div>
                        <div>
                            <span class="stat-number fw-bold fs-4">{{ $generalDocsCount }}</span>
                            <p class="stat-label text-muted small mb-0">Available</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-info bg-opacity-10 text-info small">Documents</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
--}}

    @if($finalDocument)
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-1 fw-bold">Final Approved Document</h5>
                        <small class="text-muted">
                            Your application has been approved. You can preview or download your final document below.
                        </small>
                    </div>
                    <span class="badge bg-success">Approved</span>
                </div>

                <div class="border rounded p-3 mb-3 bg-light">
                    <p class="mb-1 fw-semibold">
                        {{ $finalDocument->title ?? 'Final Document' }}
                    </p>
                    <small class="text-muted">
                        Uploaded on {{ $finalDocument->created_at->format('d M Y') }}
                    </small>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ asset('storage/' . $finalDocument->file_path) }}"
                       target="_blank"
                       class="btn btn-primary btn-sm">
                        Preview
                    </a>

                    <a href="{{ asset('storage/' . $finalDocument->file_path) }}"
                       download
                       class="btn btn-success btn-sm">
                        Download
                    </a>
                </div>

            </div>
        </div>
    @endif
    <!-- Main Content Grid -->
    <div class="row g-4">
        <!-- Left Column - Documents & Forms -->
        <div class="col-lg-8">
            <!-- Official Documents Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="bi bi-file-earmark-text text-primary me-2"></i>
                            Official Documents
                        </h5>
                        <span class="badge bg-primary px-3 py-2 rounded-pill">{{ $generalDocuments->count() }} Available</span>
                    </div>
                </div>
                <div class="card-body p-4 pt-0">
                    @if($generalDocuments->count() > 0)
                        <div class="row g-3">
                            @foreach($generalDocuments as $doc)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 hover-shadow transition">
                                        <div class="d-flex align-items-center">
                                            <div class="file-icon-wrapper me-3">
                                                @if($doc->type == 'agreement')
                                                    <div class="bg-white p-2 rounded-3 shadow-sm">
                                                        <i class="bi bi-file-pdf fs-4 text-danger"></i>
                                                    </div>
                                                @elseif($doc->type == 'challan')
                                                    <div class="bg-white p-2 rounded-3 shadow-sm">
                                                        <i class="bi bi-receipt fs-4 text-success"></i>
                                                    </div>
                                                @else
                                                    <div class="bg-white p-2 rounded-3 shadow-sm">
                                                        <i class="bi bi-file-earmark fs-4 text-secondary"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <strong class="d-block">{{ $doc->title }}</strong>
                                                <small class="text-muted">{{ strtoupper($doc->type) }}</small>
                                            </div>
                                        </div>

                                        @if($doc->type == 'agreement')
                                            <a href="{{ route('user.agreement.download') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                                <i class="bi bi-download me-1"></i> Download
                                            </a>
                                        @elseif($doc->type == 'challan')
                                            <a href="{{ route('user.challan.download') }}"
                                               class="btn btn-success btn-sm rounded-pill px-3 {{ $disableChallanDownloadBtn ? 'disabled' : '' }}"
                                                {{ $disableChallanDownloadBtn ? 'aria-disabled=true' : '' }}>
                                                <i class="bi bi-download me-1"></i> Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="empty-state-wrapper">
                                <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                                    <i class="bi bi-file-earmark-x fs-1 text-muted"></i>
                                </div>
                                <h6 class="fw-semibold mb-2">No Official Documents</h6>
                                <p class="text-muted small mb-0">Check back later for updates</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Your Uploaded Documents Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="bi bi-cloud-upload text-success me-2"></i>
                            Your Uploaded Documents
                        </h5>
                        <div>
                            <span class="badge bg-light text-dark me-2">{{ $userDocuments->count() }} Total</span>
                            <a href="{{ route('user.applications.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 pt-2">
                    @if($userDocuments->count() > 0)
                        <!-- Desktop Table View -->
                        <div class="d-none d-md-block">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                    <tr>
                                        <th>Document Name</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($userDocuments as $doc)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                                    <span class="fw-medium">{{ Str::limit($doc->original_name, 30) }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $doc->document_type ?? 'N/A' }}</td>
                                            <td>
                                                @if($doc->status == 'approved')
                                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                                        <span class="dot bg-success me-1"></span> Approved
                                                    </span>
                                                @elseif($doc->status == 'pending')
                                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                                        <span class="dot bg-warning me-1"></span> Pending
                                                    </span>
                                                @elseif($doc->status == 'rejected')
                                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                                        <span class="dot bg-danger me-1"></span> Rejected
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                                        {{ ucfirst($doc->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <a href="{{ route('user.document.preview', $doc->id) }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-primary rounded-pill px-3"
                                                       data-bs-toggle="tooltip"
                                                       title="Preview">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
{{--                                                    <a href="{{ route('user.document.download', $doc->id) }}"--}}
{{--                                                       class="btn btn-sm btn-success rounded-pill px-3"--}}
{{--                                                       data-bs-toggle="tooltip"--}}
{{--                                                       title="Download">--}}
{{--                                                        <i class="bi bi-download"></i>--}}
{{--                                                    </a>--}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="d-md-none">
                            @foreach($userDocuments as $doc)
                                <div class="card border-0 bg-light mb-3">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-start mb-2">
                                            <i class="bi bi-file-earmark-text fs-4 text-primary me-2"></i>
                                            <div class="flex-grow-1">
                                                <strong class="d-block">{{ Str::limit($doc->original_name, 25) }}</strong>
                                                <small class="text-muted">{{ $doc->document_type ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            @if($doc->status == 'approved')
                                                <span class="badge bg-success px-3 py-2">Approved</span>
                                            @elseif($doc->status == 'pending')
                                                <span class="badge bg-warning px-3 py-2">Pending</span>
                                            @elseif($doc->status == 'rejected')
                                                <span class="badge bg-danger px-3 py-2">Rejected</span>
                                            @else
                                                <span class="badge bg-secondary px-3 py-2">{{ ucfirst($doc->status) }}</span>
                                            @endif
                                            <div>
                                                <a href="{{ route('user.document.preview', $doc->id) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle p-2 me-1">
                                                    <i class="bi bi-eye"></i>
                                                </a>
{{--                                                <a href="{{ route('user.document.download', $doc->id) }}" class="btn btn-sm btn-success rounded-circle p-2">--}}
{{--                                                    <i class="bi bi-download"></i>--}}
{{--                                                </a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state-wrapper">
                                <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                                    <i class="bi bi-cloud-upload fs-1 text-muted"></i>
                                </div>
                                <h6 class="fw-semibold mb-2">No Documents Uploaded</h6>
                                <p class="text-muted mb-3">Get started by uploading your first document</p>
                                @if(auth()->user()->hasPermission('upload_documents'))
                                    <a href="{{ route('user.application.create') }}" class="btn btn-primary px-4 py-2 rounded-pill">
                                        <i class="bi bi-cloud-upload me-2"></i>Upload Now
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Quick Actions & Recent Activity -->
        <div class="col-lg-4">
            <!-- Quick Actions Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-lightning-charge text-warning me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-3">
                        @if(auth()->user()->hasPermission('upload_documents'))
                            <a href="{{ route('user.application.create') }}"
                               class="btn btn-primary py-3 d-flex align-items-center justify-content-between rounded-3 shadow-sm {{ $disableNewApplicationButton ? 'disabled' : '' }}"  {{ $disableNewApplicationButton  ? 'aria-disabled=true' : ''}}>
                                <span><i class="bi bi-cloud-upload fs-5 me-2"></i>Upload Documents</span>
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        @endif

                        <a href="{{ route('user.applications.index') }}"
                           class="btn btn-outline-info py-3 d-flex align-items-center justify-content-between rounded-3">
                            <span><i class="bi bi-folder fs-5 me-2"></i>My Documents</span>
                            <i class="bi bi-arrow-right-circle"></i>
                        </a>

                        <a href="{{ route('user.profile') }}"
                           class="btn btn-outline-secondary py-3 d-flex align-items-center justify-content-between rounded-3">
                            <span><i class="bi bi-person fs-5 me-2"></i>Update Profile</span>
                            <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Uploads Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="bi bi-clock-history text-primary me-2"></i>
                            Recent Uploads
                        </h5>
                        @if($userDocuments->count() > 0)
                            <small class="text-muted">Last 3</small>
                        @endif
                    </div>
                </div>
                <div class="card-body p-4">
                    @if($userDocuments->count() > 0)
                        @foreach($userDocuments->take(3) as $document)
                            <div class="recent-upload-item d-flex align-items-start mb-3 pb-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="recent-upload-icon me-3">
                                    <div class="bg-light p-2 rounded-3">
                                        @php
                                            $statusColor = $document->status == 'approved' ? 'success' : ($document->status == 'pending' ? 'warning' : 'danger');
                                        @endphp
                                        <i class="bi bi-file-earmark-text fs-4 text-{{ $statusColor }}"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-semibold mb-1 small">{{ Str::limit($document->original_name, 25) }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }} px-2 py-1 rounded-pill">
                                            {{ ucfirst($document->status) }}
                                        </span>
                                        <small class="text-muted">{{ $document->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if($userDocuments->count() > 3)
                            <div class="text-center mt-3">
                                <a href="{{ route('user.applications.index') }}" class="btn btn-link text-decoration-none">
                                    View All Uploads <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <div class="bg-light rounded-circle d-inline-flex p-3 mb-3">
                                <i class="bi bi-upload text-muted fs-3"></i>
                            </div>
                            <h6 class="fw-semibold mb-2 small">No Uploads Yet</h6>
                            <p class="text-muted small mb-3">Your uploaded files will appear here</p>
                            @if(auth()->user()->hasPermission('upload_documents'))
                                <a href="{{ route('user.application.create') }}" class="btn btn-primary btn-sm px-4 rounded-pill">
                                    Upload Now
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 bg-light">
                    <h5 class="modal-title">
                        <i class="bi bi-file-earmark-text me-2 text-primary"></i>
                        Document Preview
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <img id="previewImage" class="img-fluid rounded-3 d-none" style="max-height: 400px;">
                    <iframe id="previewPdf" class="w-100 d-none" style="height: 500px;" frameborder="0"></iframe>
                    <div id="previewNotAvailable" class="py-5 d-none">
                        <div class="empty-state-wrapper">
                            <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                                <i class="bi bi-eye-slash fs-1 text-muted"></i>
                            </div>
                            <h5>Preview Not Available</h5>
                            <p class="text-muted">This file type cannot be previewed online.</p>
                            <a href="#" class="btn btn-primary mt-2" id="downloadFromPreview">Download File</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- Enhanced Styles -->
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
        --shadow-hover: 0 10px 30px rgba(0,0,0,0.15);
    }

    /* Dashboard Header */
    .dashboard-header .card {
        border-radius: 30px !important;
    }

    .avatar-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .avatar-circle:hover {
        transform: rotate(0deg) scale(1.1) !important;
    }

    .opacity-10 {
        opacity: 0.1;
    }

    /* Stat Cards */
    .stat-card {
        border-radius: 20px !important;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover) !important;
    }

    .stat-card:hover::after {
        opacity: 1;
    }

    .stat-icon-wrapper {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    @media (min-width: 768px) {
        .stat-icon-wrapper {
            width: 60px;
            height: 60px;
        }
    }

    .stat-card:hover .stat-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
    }

    .stat-number {
        color: #2d3748;
        line-height: 1.2;
    }

    /* Dot for status badges */
    .dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 6px;
    }

    /* File icon wrapper */
    .file-icon-wrapper {
        transition: all 0.3s ease;
    }

    .file-icon-wrapper:hover {
        transform: scale(1.2) rotate(5deg);
    }

    /* Recent Upload Item */
    .recent-upload-item {
        transition: all 0.3s ease;
    }

    .recent-upload-item:hover {
        transform: translateX(8px);
        background-color: rgba(13, 110, 253, 0.03);
        border-radius: 12px;
        padding-left: 8px;
    }

    .recent-upload-icon {
        transition: all 0.3s ease;
    }

    .recent-upload-item:hover .recent-upload-icon {
        transform: scale(1.1);
    }

    /* Empty State */
    .empty-state-wrapper {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Hover Shadow */
    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
        transform: translateY(-2px);
    }

    /* Transition */
    .transition {
        transition: all 0.3s ease;
    }

    /* Button hover effects */
    .btn-primary, .btn-outline-info, .btn-outline-secondary {
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #3a4ab0, #b13eaa);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(65, 88, 208, 0.4);
    }

    .btn-outline-info:hover,
    .btn-outline-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #4158D0, #C850C0);
        border-radius: 10px;
    }

    /* Mobile optimizations */
    @media (max-width: 767.98px) {
        .dashboard-header .card-body {
            padding: 1.5rem !important;
        }

        .avatar-circle {
            width: 50px !important;
            height: 50px !important;
        }

        .avatar-circle i {
            font-size: 2rem !important;
        }

        .stat-card .card-body {
            padding: 1rem !important;
        }

        .stat-icon-wrapper {
            width: 40px !important;
            height: 40px !important;
            padding: 0.5rem !important;
        }

        .stat-icon-wrapper i {
            font-size: 1.2rem !important;
        }

        .stat-number {
            font-size: 1.3rem !important;
        }
    }

    @media (max-width: 575.98px) {
        .badge {
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
        }

        .btn-sm.rounded-circle {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    }

    /* Smooth animations */
    .card, .btn, .badge {
        transition: all 0.3s ease;
    }

    /* Modal improvements */
    .modal-content {
        border-radius: 25px;
    }

    /* Table improvements */
    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #4a5568;
        border-bottom-width: 1px;
    }

    /* Tooltip styles (if needed) */
    [data-bs-toggle="tooltip"] {
        cursor: pointer;
    }
</style>

<!-- JavaScript remains exactly the same -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Preview functionality
        document.querySelectorAll('.preview-btn').forEach(button => {
            button.addEventListener('click', function () {
                let url = this.dataset.url;
                let mime = this.dataset.mime;

                let img = document.getElementById('previewImage');
                let pdf = document.getElementById('previewPdf');
                let notAvailable = document.getElementById('previewNotAvailable');
                let downloadBtn = document.getElementById('downloadFromPreview');

                img.classList.add('d-none');
                pdf.classList.add('d-none');
                notAvailable.classList.add('d-none');

                if (mime.startsWith('image/')) {
                    img.src = url;
                    img.classList.remove('d-none');
                } else if (mime === 'application/pdf') {
                    pdf.src = url;
                    pdf.classList.remove('d-none');
                } else {
                    downloadBtn.href = url;
                    notAvailable.classList.remove('d-none');
                }

                new bootstrap.Modal(document.getElementById('previewModal')).show();
            });
        });
    });
</script>
