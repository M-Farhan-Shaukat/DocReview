@extends('user.layouts.app')

@section('title', 'User Dashboard')

@section('content')
    <!-- Dashboard Header with Gradient -->
    <div class="dashboard-header mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-8">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-white shadow-lg me-3" style="width: 60px; height: 60px; border-radius: 20px;">
                                        <i class="bi bi-person-circle fs-1 text-primary"></i>
                                    </div>
                                    <div class="text-white">
                                        <h1 class="h4 h3-md fw-bold mb-1">Welcome back, {{ auth()->user()->name }}!</h1>
                                        <p class="mb-0 opacity-75 small d-flex align-items-center">
                                            <i class="bi bi-calendar3 me-2"></i>
                                            {{ now()->format('l, F j, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 text-lg-end mt-3 mt-lg-0">
                                <div class="badge bg-white text-primary p-3 rounded-3 shadow-sm d-inline-flex align-items-center">
                                    <i class="bi bi-shield-check fs-5 me-2"></i>
                                    <div class="text-start">
                                        <small class="text-secondary d-block">Your Role</small>
                                        <span class="fw-bold">{{ auth()->user()->role->name ?? 'User' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards with Modern Design -->
    <div class="row g-3 g-md-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center p-3 p-md-4">
                    <div class="stat-icon-wrapper bg-info bg-opacity-10 rounded-3 mx-auto mb-3 p-3">
                        <i class="bi bi-folder fs-3 text-info"></i>
                    </div>
                    <h3 class="stat-number fw-bold mb-1 fs-4">{{ $uploadedCount ?? 0 }}</h3>
                    <p class="stat-label text-muted small text-uppercase fw-semibold tracking-wide">Uploaded</p>
                    <div class="mt-2">
                        <span class="badge bg-info bg-opacity-10 text-info px-2 py-1">Documents</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center p-3 p-md-4">
                    <div class="stat-icon-wrapper bg-warning bg-opacity-10 rounded-3 mx-auto mb-3 p-3">
                        <i class="bi bi-clock fs-3 text-warning"></i>
                    </div>
                    <h3 class="stat-number fw-bold mb-1 fs-4">{{ $pendingCount ?? 0 }}</h3>
                    <p class="stat-label text-muted small text-uppercase fw-semibold tracking-wide">Pending</p>
                    <div class="mt-2">
                        <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1">Review</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center p-3 p-md-4">
                    <div class="stat-icon-wrapper bg-success bg-opacity-10 rounded-3 mx-auto mb-3 p-3">
                        <i class="bi bi-check-circle fs-3 text-success"></i>
                    </div>
                    <h3 class="stat-number fw-bold mb-1 fs-4">{{ $approvedCount ?? 0 }}</h3>
                    <p class="stat-label text-muted small text-uppercase fw-semibold tracking-wide">Approved</p>
                    <div class="mt-2">
                        <span class="badge bg-success bg-opacity-10 text-success px-2 py-1">Verified</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body text-center p-3 p-md-4">
                    <div class="stat-icon-wrapper bg-primary bg-opacity-10 rounded-3 mx-auto mb-3 p-3">
                        <i class="bi bi-file-earmark-text fs-3 text-primary"></i>
                    </div>
                    <h3 class="stat-number fw-bold mb-1 fs-4">{{ count($attachments) }}</h3>
                    <p class="stat-label text-muted small text-uppercase fw-semibold tracking-wide">Forms</p>
                    <div class="mt-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1">Available</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Workflow with Timeline Design -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-clipboard-check text-primary me-2"></i>
                        Application Progress Timeline
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="workflow-timeline">
                        <!-- Desktop Timeline -->
                        <div class="d-none d-md-flex justify-content-between position-relative">
                            <div class="timeline-line"></div>

                            <div class="timeline-step {{ $uploadedCount > 0 ? 'completed' : '' }}">
                                <div class="timeline-icon">
                                    <i class="bi bi-person-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-semibold mb-1">Registration</h6>
                                    <small class="text-muted">Account Created</small>
                                </div>
                            </div>

                            <div class="timeline-step {{ $uploadedCount > 0 ? 'active' : '' }}">
                                <div class="timeline-icon">
                                    <i class="bi bi-cloud-upload"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-semibold mb-1">Document Upload</h6>
                                    <small class="text-muted">{{ $uploadedCount > 0 ? 'Completed' : 'Pending' }}</small>
                                </div>
                            </div>

                            <div class="timeline-step {{ $approvedCount > 0 ? 'active' : '' }}">
                                <div class="timeline-icon">
                                    <i class="bi bi-file-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-semibold mb-1">Review</h6>
                                    <small class="text-muted">{{ $approvedCount > 0 ? 'In Progress' : 'Pending' }}</small>
                                </div>
                            </div>

                            <div class="timeline-step">
                                <div class="timeline-icon">
                                    <i class="bi bi-credit-card"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-semibold mb-1">Payment</h6>
                                    <small class="text-muted">Pending</small>
                                </div>
                            </div>

                            <div class="timeline-step">
                                <div class="timeline-icon">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-semibold mb-1">Complete</h6>
                                    <small class="text-muted">Final Step</small>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Timeline Cards -->
                        <div class="d-md-none">
                            @php
                                $steps = [
                                    ['icon' => 'person-check', 'label' => 'Registration', 'status' => 'completed', 'active' => true],
                                    ['icon' => 'cloud-upload', 'label' => 'Upload', 'status' => $uploadedCount > 0 ? 'active' : 'pending', 'active' => $uploadedCount > 0],
                                    ['icon' => 'file-check', 'label' => 'Review', 'status' => $approvedCount > 0 ? 'active' : 'pending', 'active' => $approvedCount > 0],
                                    ['icon' => 'credit-card', 'label' => 'Payment', 'status' => 'pending', 'active' => false],
                                    ['icon' => 'check-circle', 'label' => 'Complete', 'status' => 'pending', 'active' => false],
                                ];
                            @endphp

                            @foreach($steps as $index => $step)
                                <div class="timeline-mobile-step d-flex align-items-center mb-3">
                                    <div class="timeline-mobile-icon me-3
                                        @if($step['status'] == 'completed') bg-success
                                        @elseif($step['status'] == 'active') bg-primary
                                        @else bg-secondary @endif">
                                        <i class="bi bi-{{ $step['icon'] }} text-white"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-semibold">{{ $step['label'] }}</h6>
                                            @if($step['status'] == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @elseif($step['status'] == 'active')
                                                <span class="badge bg-primary">In Progress</span>
                                            @else
                                                <span class="badge bg-secondary">Pending</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
            <div class="card border-0 shadow-sm h-100" id="available-forms">
                <div class="card-header bg-white border-0 pt-4 pb-2 px-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-file-earmark-text text-info me-2"></i>
                        Available Documents
                    </h5>
                    <span class="badge bg-info px-3 py-2 rounded-pill">{{ count($attachments) }} Files</span>
                </div>
                <div class="card-body p-3 p-md-4">
                    @if(count($attachments) > 0)
                        <!-- Desktop Table View -->
                        <div class="table-responsive d-none d-md-block">
                            <table class="table table-hover align-middle">
                                <thead class="bg-light">
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
                                                <div class="file-icon-wrapper me-3 p-2 rounded-3" style="background: rgba({{ $attachment->file_color == 'primary' ? '13,110,253' : ($attachment->file_color == 'success' ? '25,135,84' : '13,202,240') }}, 0.1)">
                                                    <i class="bi {{ $attachment->file_icon }} fs-4 text-{{ $attachment->file_color }}"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium">{{ Str::limit($attachment->original_name, 30) }}</div>
                                                    <small class="text-muted">Uploaded: {{ $attachment->created_at->format('M d, Y') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                                <span class="badge bg-light text-dark border px-3 py-2">
                                                    {{ strtoupper(pathinfo($attachment->original_name, PATHINFO_EXTENSION) ?: 'N/A') }}
                                                </span>
                                        </td>
                                        <td><span class="text-muted fw-medium">{{ $attachment->formatted_size }}</span></td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <button
                                                    class="btn btn-sm btn-primary preview-btn"
                                                    data-url="{{ route('user.attachments.view', $attachment->id) }}"
                                                    data-mime="{{ $attachment->mime_type }}"
                                                >
                                                    Preview
                                                </button>
                                                <a href="{{ route('user.attachments.download', $attachment->id) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="bi bi-download me-1"></i> Download
                                                </a>
                                                <div class="modal fade" id="previewModal" tabindex="-1">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title">File Preview</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <div class="modal-body text-center">

                                                                <img id="previewImage" class="img-fluid d-none"/>

                                                                <iframe id="previewPdf"
                                                                        class="d-none"
                                                                        width="100%"
                                                                        height="600px"
                                                                        style="border:none;">
                                                                </iframe>

                                                                <p id="previewNotAvailable" class="d-none">
                                                                    Preview not available
                                                                </p>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

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
                                <div class="card border-0 bg-light mb-3">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="file-icon-wrapper me-3 p-3 rounded-3" style="background: rgba({{ $attachment->file_color == 'primary' ? '13,110,253' : ($attachment->file_color == 'success' ? '25,135,84' : '13,202,240') }}, 0.1)">
                                                <i class="bi {{ $attachment->file_icon }} fs-3 text-{{ $attachment->file_color }}"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-semibold mb-1">{{ Str::limit($attachment->original_name, 25) }}</h6>
                                                <div class="d-flex flex-wrap gap-2 mb-2">
                                                    <span class="badge bg-light text-dark border">{{ strtoupper(pathinfo($attachment->original_name, PATHINFO_EXTENSION) ?: 'N/A') }}</span>
                                                    <span class="badge bg-light text-dark border">{{ $attachment->formatted_size }}</span>
                                                </div>
                                                <small class="text-muted d-block">
                                                    <i class="bi bi-calendar me-1"></i>{{ $attachment->created_at->format('M d, Y') }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('user.attachments.view', $attachment->id) }}"
                                               class="btn btn-sm btn-primary px-3"
                                               target="_blank">
                                                <i class="bi bi-eye me-1"></i> View
                                            </a>
                                            <a href="{{ route('user.attachments.download', $attachment->id) }}"
                                               class="btn btn-sm btn-success px-3">
                                                <i class="bi bi-download me-1"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state-wrapper mb-3">
                                <div class="bg-light rounded-circle d-inline-flex p-4">
                                    <i class="bi bi-folder-x text-muted fs-1"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-2">No Documents Available</h6>
                            <p class="text-muted small mb-0">Check back later for new forms and documents</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions & Recent Uploads -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-lightning-charge text-warning me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body p-3 p-md-4">
                    <div class="d-grid gap-2">
                        @if(auth()->user()->hasPermission('upload_documents'))
                            <a href="{{ route('user.documents.upload') }}" class="btn btn-primary py-3 d-flex align-items-center justify-content-start">
                                <i class="bi bi-cloud-upload fs-5 me-3"></i>
                                <span class="flex-grow-1 text-start">Upload Documents</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @endif

                        <a href="{{ route('user.documents') }}" class="btn btn-outline-info py-3 d-flex align-items-center justify-content-start">
                            <i class="bi bi-folder fs-5 me-3"></i>
                            <span class="flex-grow-1 text-start">My Documents</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>

                        <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary py-3 d-flex align-items-center justify-content-start">
                            <i class="bi bi-person fs-5 me-3"></i>
                            <span class="flex-grow-1 text-start">Update Profile</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Uploads -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-clock-history text-primary me-2"></i>
                        Recent Uploads
                    </h5>
                </div>
                <div class="card-body p-3 p-md-4">
                    @if(count($userDocuments) > 0)
                        @foreach($userDocuments->take(3) as $document)
                            <div class="recent-upload-item d-flex align-items-start mb-3 pb-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="recent-upload-icon me-3">
                                    <div class="bg-light p-2 rounded-3">
                                        <i class="bi bi-file-earmark-text fs-4 text-{{ $document->status_color ?? 'secondary' }}"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-semibold mb-1 small">{{ Str::limit($document->original_name, 20) }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-{{ $document->status_color ?? 'secondary' }} bg-opacity-10 text-{{ $document->status_color ?? 'secondary' }} px-2 py-1">
                                            {{ ucfirst($document->status ?? 'Pending') }}
                                        </span>
                                        <small class="text-muted">{{ $document->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if(count($userDocuments) > 3)
                            <div class="text-center mt-3">
                                <a href="{{ route('user.documents') }}" class="btn btn-link text-decoration-none">
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
                            <p class="text-muted small mb-3">Start by uploading your first document</p>
                            @if(auth()->user()->hasPermission('upload_documents'))
                                <a href="{{ route('user.documents.upload') }}" class="btn btn-primary btn-sm px-4">
                                    Upload Now
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Modern Dashboard Styles */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
        --shadow-lg: 0 8px 24px rgba(102, 126, 234, 0.15);
    }

    /* Dashboard Header */
    .dashboard-header .card {
        border-radius: 24px !important;
    }

    .avatar-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .avatar-circle:hover {
        transform: scale(1.05);
    }

    /* Stat Cards */
    .stat-card {
        border-radius: 20px !important;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg) !important;
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-icon-wrapper {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon-wrapper {
        transform: scale(1.1);
    }

    .stat-number {
        color: #2d3748;
        font-size: 2rem;
    }

    .tracking-wide {
        letter-spacing: 0.5px;
    }

    /* Timeline Styles */
    .workflow-timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline-line {
        position: absolute;
        top: 35px;
        left: 8%;
        right: 8%;
        height: 3px;
        background: linear-gradient(90deg, #e9ecef 0%, #e9ecef 100%);
        z-index: 1;
    }

    .timeline-step {
        position: relative;
        z-index: 2;
        text-align: center;
        flex: 1;
    }

    .timeline-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.3rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .timeline-step.completed .timeline-icon {
        background: #198754;
        color: white;
        box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.2);
    }

    .timeline-step.active .timeline-icon {
        background: #0d6efd;
        color: white;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.2);
        animation: pulse 2s infinite;
    }

    .timeline-step .timeline-icon {
        background: #e9ecef;
        color: #6c757d;
    }

    .timeline-content h6 {
        font-size: 0.9rem;
        margin-bottom: 4px;
    }

    .timeline-content small {
        font-size: 0.75rem;
    }

    /* Mobile Timeline */
    .timeline-mobile-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .timeline-mobile-icon.bg-success {
        background: linear-gradient(135deg, #198754, #20c997);
    }

    .timeline-mobile-icon.bg-primary {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
    }

    .timeline-mobile-icon.bg-secondary {
        background: linear-gradient(135deg, #6c757d, #5a6268);
    }

    /* File Icon Wrapper */
    .file-icon-wrapper {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .file-icon-wrapper:hover {
        transform: scale(1.1);
    }

    /* Recent Upload Item */
    .recent-upload-item {
        transition: all 0.3s ease;
    }

    .recent-upload-item:hover {
        transform: translateX(5px);
    }

    .recent-upload-icon {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
    }

    /* Empty State */
    .empty-state-wrapper {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(13, 110, 253, 0); }
        100% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0); }
    }

    /* Mobile Optimizations */
    @media (max-width: 767.98px) {
        .stat-icon-wrapper {
            width: 55px;
            height: 55px;
        }

        .stat-icon-wrapper i {
            font-size: 1.5rem !important;
        }

        .stat-number {
            font-size: 1.5rem;
        }

        .btn-group .btn {
            padding: 0.5rem 1rem;
        }

        .badge {
            font-size: 0.7rem;
        }

        .timeline-mobile-icon {
            width: 40px;
            height: 40px;
        }

        .timeline-mobile-icon i {
            font-size: 1rem;
        }
    }

    @media (max-width: 575.98px) {
        .card-body {
            padding: 1rem !important;
        }

        .stat-icon-wrapper {
            width: 45px;
            height: 45px;
        }

        .stat-icon-wrapper i {
            font-size: 1.2rem !important;
        }

        h5 {
            font-size: 1rem;
        }

        .btn.py-3 {
            padding: 0.75rem !important;
        }
    }

    /* Button Styles */
    .btn-primary {
        background: var(--primary-gradient);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-outline-primary:hover,
    .btn-outline-success:hover,
    .btn-outline-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Card Hover Effects */
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: var(--shadow-md) !important;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
    }
</style>
<script>

    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.preview-btn').forEach(button => {

            button.addEventListener('click', function () {

                let url = this.dataset.url;
                let mime = this.dataset.mime;

                let img = document.getElementById('previewImage');
                let pdf = document.getElementById('previewPdf');
                let notAvailable = document.getElementById('previewNotAvailable');

                img.classList.add('d-none');
                pdf.classList.add('d-none');
                notAvailable.classList.add('d-none');

                if (mime.startsWith('image/')) {

                    img.src = url;
                    img.classList.remove('d-none');

                }
                else if (mime === 'application/pdf') {

                    pdf.src = url;
                    pdf.classList.remove('d-none');

                }
                else {

                    notAvailable.classList.remove('d-none');

                }

                new bootstrap.Modal(document.getElementById('previewModal')).show();

            });

        });

    });
</script>

