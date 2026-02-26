@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">

        <!-- Header with Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #1e2b6f 0%, #2b3a8a 50%, #3a4a9f 100%);">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('admin.applications.index') }}"
                                       class="btn btn-light btn-sm rounded-circle p-2 me-3"
                                       style="width: 38px; height: 38px;">
                                        <i class="bi bi-arrow-left"></i>
                                    </a>
                                    <div>
                                        <h2 class="fw-bold text-white mb-1">Application Details</h2>
                                        <p class="text-white-50 mb-0">Review and manage application #{{ $application->id }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <span class="badge bg-white text-dark px-4 py-3 rounded-pill shadow-sm">
                                    <i class="bi bi-files me-2"></i>
                                    ID: {{ $application->unique_id }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="row g-4">
            <!-- Left Column - Application Info & Actions -->
            <div class="col-lg-5">
                <!-- Application Info Card -->
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-header bg-white border-0 py-3 px-4">
                        <h5 class="fw-semibold mb-0">
                            <i class="bi bi-info-circle text-primary me-2"></i>
                            Application Information
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="bi bi-person-circle fs-2 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1">{{ $application->user->name }}</h4>
                                <p class="text-muted mb-0">{{ $application->user->email }}</p>
                            </div>
                        </div>

                        <div class="info-grid">
                            <div class="mb-3 p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1">Application ID</small>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-hash text-primary me-2"></i>
                                    <span class="fw-semibold fs-5">#{{ $application->id }}</span>
                                </div>
                            </div>

                            <div class="mb-3 p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1">Unique Identifier</small>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-qr-code text-info me-2"></i>
                                    <code class="fw-semibold">{{ $application->unique_id }}</code>
                                </div>
                            </div>

                            <div class="mb-3 p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1">Current Status</small>
                                <div class="d-flex align-items-center">
                                    @if($application->status == 'pending')
                                        <span class="badge bg-warning bg-opacity-25 text-warning px-4 py-3 rounded-pill fs-6">
                                            <span class="dot bg-warning me-2"></span> Pending Review
                                        </span>
                                    @elseif($application->status == 'approved')
                                        <span class="badge bg-success bg-opacity-25 text-success px-4 py-3 rounded-pill fs-6">
                                            <span class="dot bg-success me-2"></span> Approved
                                        </span>
                                    @elseif($application->status == 'rejected')
                                        <span class="badge bg-danger bg-opacity-25 text-danger px-4 py-3 rounded-pill fs-6">
                                            <span class="dot bg-danger me-2"></span> Rejected
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-25 text-secondary px-4 py-3 rounded-pill fs-6">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1">Submitted On</small>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar3 text-success me-2"></i>
                                    <span>{{ $application->created_at->format('d M Y, h:i A') }}</span>
                                </div>
                            </div>

                            @if($application->updated_at)
                                <div class="mb-3 p-3 bg-light rounded-3">
                                    <small class="text-muted d-block mb-1">Last Updated</small>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-clock-history text-warning me-2"></i>
                                        <span>{{ $application->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Cards -->
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white border-0 py-3 px-4">
                        <h5 class="fw-semibold mb-0">
                            <i class="bi bi-lightning-charge text-warning me-2"></i>
                            Review Actions
                        </h5>
                    </div>
                    <div class="card-body p-4">
{{--                        @if($application->status == 'pending')--}}
                            <div class="alert alert-info bg-light border-0 d-flex align-items-center mb-4">
                                <i class="bi bi-info-circle fs-4 me-3 text-info"></i>
                                <div>
                                    <strong>Ready for review</strong>
                                    <p class="mb-0 small">Review documents below before making a decision.</p>
                                </div>
                            </div>

                            <div class="d-grid gap-3">
                                <!-- Approve Button -->
                                <form action="{{ route('admin.applications.approve', $application->id) }}"
                                      method="POST"
                                      id="approveForm">
                                    @csrf
                                    <button type="button"
                                            class="btn btn-success w-100 py-3 d-flex align-items-center justify-content-center"
                                            onclick="confirmApprove()">
                                        <i class="bi bi-check-circle fs-5 me-2"></i>
                                        Approve Application
                                    </button>
                                </form>

                                <!-- Reject Form with Reason -->
                                <div class="card border-0 bg-light">
                                    <div class="card-body p-3">
                                        <form action="{{ route('admin.applications.rejected', $application->id) }}"
                                              method="POST"
                                              id="rejectForm">
                                            @csrf
                                            <label class="fw-semibold mb-2 small text-uppercase text-muted">
                                                <i class="bi bi-chat-text me-1"></i>
                                                Rejection Reason
                                            </label>
                                            <textarea name="reason"
                                                      rows="3"
                                                      class="form-control mb-3 border-0 shadow-sm"
                                                      placeholder="Please provide a reason for rejection..."
                                                      required></textarea>

                                            <button type="button"
                                                    class="btn btn-danger w-100 py-3 d-flex align-items-center justify-content-center"
                                                    onclick="confirmReject()">
                                                <i class="bi bi-x-circle fs-5 me-2"></i>
                                                Reject Application
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card border-0 bg-light">
                                    <div class="card-body p-3">
                                        <form action="{{ route('admin.applications.onhold', $application->id) }}"
                                              method="POST"
                                              id="holdForm">
                                            @csrf
                                            <label class="fw-semibold mb-2 small text-uppercase text-muted">
                                                <i class="bi bi-chat-text me-1"></i>
                                                OnHols Remarks
                                            </label>
                                            <textarea name="onhold_remarks"
                                                      rows="3"
                                                      class="form-control mb-3 border-0 shadow-sm"
                                                      placeholder="Please provide a remarks for onhold this application..."
                                                      required></textarea>

                                            <button type="button"
                                                    class="btn btn-secondary w-100 py-3 d-flex align-items-center justify-content-center"
                                                    onclick="confirmOnhold()">
                                                <i class="bi bi-pause-circle fs-5 me-2 text-black"></i>
                                                Onhold this Application
                                            </button>
                                        </form>
                                    </div>
                                </div>   <div class="card border-0 bg-light">
                                    <div class="card-body p-3">
                                        <form action="{{ route('admin.applications.recommended', $application->id) }}"
                                              method="POST"
                                              id="recommendedForm">
                                            @csrf
                                            <label class="fw-semibold mb-2 small text-uppercase text-muted">
                                                <i class="bi bi-chat-text me-1"></i>
                                                Recommended Remarks
                                            </label>
                                            <textarea name="recommended_remarks"
                                                      rows="3"
                                                      class="form-control mb-3 border-0 shadow-sm"
                                                      placeholder="Please provide a Remarks og Recommendation..."
                                                      required></textarea>

                                            <button type="button"
                                                    class="btn btn-primary w-100 py-3 d-flex align-items-center justify-content-center"
                                                    onclick="confirmRecommend()">
                                                <i class="bi bi-award fs-5 me-2 text-info"></i>
                                                Recommend Application
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                       {{-- @else
                            <div class="text-center py-4">
                                <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                                    @if($application->status == 'approved')
                                        <i class="bi bi-check-circle fs-1 text-success"></i>
                                    @elseif($application->status == 'rejected')
                                        <i class="bi bi-x-circle fs-1 text-danger"></i>
                                    @endif
                                </div>
                                <h5 class="fw-semibold mb-2">
                                    Application {{ ucfirst($application->status) }}
                                </h5>
                                <p class="text-muted mb-3">This application has been processed.</p>
                                <a href="{{ route('admin.applications.index') }}"
                                   class="btn btn-outline-primary rounded-pill px-4">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    Back to List
                                </a>
                            </div>
                        @endif--}}
                    </div>
                </div>
            </div>

            <!-- Right Column - Documents -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white border-0 py-3 px-4">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <h5 class="fw-semibold mb-0">
                                <i class="bi bi-files text-primary me-2"></i>
                                Uploaded Documents
                            </h5>
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                {{ $documents->count() }} {{ Str::plural('file', $documents->count()) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if($documents->count() > 0)
                            <!-- Desktop Table View -->
                            <div class="d-none d-md-block">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                    <tr>
                                        <th>Document Name</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($documents as $doc)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $extension = pathinfo($doc->original_name, PATHINFO_EXTENSION);
                                                        $icon = in_array(strtolower($extension), ['pdf']) ? 'bi-file-pdf text-danger' :
                                                               (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']) ? 'bi-file-image text-primary' : 'bi-file-earmark-text text-secondary');
                                                    @endphp
                                                    <i class="bi {{ $icon }} fs-4 me-2"></i>
                                                    <div>
                                                        <strong class="d-block">{{ Str::limit($doc->original_name, 30) }}</strong>
                                                        <small class="text-muted">{{ strtoupper($extension) }}</small>
                                                    </div>
                                                </div>
                                            </td>
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
                                            <td class="text-center">
                                                <a href="{{ route('admin.document.preview', $doc->id) }}"
                                                   target="_blank"
                                                   class="btn btn-primary btn-sm rounded-pill px-4">
                                                    <i class="bi bi-eye me-1"></i> Preview
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile Card View -->
                            <div class="d-md-none">
                                @foreach($documents as $doc)
                                    <div class="card border-0 bg-light mb-3">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-start mb-2">
                                                @php
                                                    $extension = pathinfo($doc->original_name, PATHINFO_EXTENSION);
                                                    $icon = in_array(strtolower($extension), ['pdf']) ? 'bi-file-pdf text-danger' :
                                                           (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']) ? 'bi-file-image text-primary' : 'bi-file-earmark-text text-secondary');
                                                @endphp
                                                <i class="bi {{ $icon }} fs-3 me-2"></i>
                                                <div class="flex-grow-1">
                                                    <strong class="d-block">{{ Str::limit($doc->original_name, 25) }}</strong>
                                                    <small class="text-muted">{{ strtoupper($extension) }}</small>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                @if($doc->status == 'approved')
                                                    <span class="badge bg-success px-3 py-2 rounded-pill">Approved</span>
                                                @elseif($doc->status == 'pending')
                                                    <span class="badge bg-warning px-3 py-2 rounded-pill">Pending</span>
                                                @elseif($doc->status == 'rejected')
                                                    <span class="badge bg-danger px-3 py-2 rounded-pill">Rejected</span>
                                                @else
                                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ ucfirst($doc->status) }}</span>
                                                @endif

                                                <a href="{{ route('admin.document.preview', $doc->id) }}"
                                                   target="_blank"
                                                   class="btn btn-primary btn-sm rounded-pill px-3">
                                                    <i class="bi bi-eye me-1"></i> Preview
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="empty-state">
                                    <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                                        <i class="bi bi-file-earmark-x fs-1 text-muted"></i>
                                    </div>
                                    <h5 class="fw-semibold mb-2">No Documents Uploaded</h5>
                                    <p class="text-muted mb-0">This application has no uploaded documents.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
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
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .info-grid {
            display: grid;
            gap: 1rem;
        }

        .empty-state {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Card enhancements */
        .card {
            border-radius: 20px !important;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }

        /* Table styles */
        .table thead th {
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #4a5568;
            border-bottom-width: 2px;
        }

        .table td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
        }

        /* Button enhancements */
        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-success {
            background: linear-gradient(135deg, #198754, #20c997);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e2b6f, #2b3a8a);
            border: none;
        }

        /* Form controls */
        textarea.form-control {
            border-radius: 15px;
            resize: none;
        }

        textarea.form-control:focus {
            box-shadow: 0 0 0 3px rgba(30, 43, 111, 0.1);
            border-color: #1e2b6f;
        }

        /* Badge enhancements */
        .badge {
            font-weight: 500;
        }

        .badge.rounded-pill {
            padding: 0.5rem 1rem;
        }

        /* Mobile optimizations */
        @media (max-width: 767.98px) {
            .container-fluid {
                padding-left: 12px;
                padding-right: 12px;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }

            .btn.py-3 {
                padding: 0.75rem !important;
            }

            .badge {
                font-size: 0.75rem;
            }

            .card-body {
                padding: 1.25rem !important;
            }
        }

        @media (max-width: 575.98px) {
            h2 {
                font-size: 1.5rem;
            }

            .btn.rounded-circle {
                width: 32px !important;
                height: 32px !important;
                padding: 0 !important;
            }
        }

        /* Alert customization */
        .alert-info {
            border-left: 4px solid #0dcaf0;
            border-radius: 12px;
        }

        /* Hover effects for table rows */
        .table-hover tbody tr:hover {
            background-color: rgba(30, 43, 111, 0.02);
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        /* Code styling */
        code {
            background-color: #f8f9fa;
            padding: 0.2rem 0.4rem;
            border-radius: 6px;
            font-size: 0.875rem;
        }

        /* File icon wrapper */
        .file-icon-wrapper {
            transition: all 0.3s ease;
        }

        .file-icon-wrapper:hover {
            transform: scale(1.2) rotate(5deg);
        }

        /* Action card styling */
        .bg-light.rounded-3 {
            transition: all 0.3s ease;
        }

        .bg-light.rounded-3:hover {
            background-color: #f0f3ff !important;
        }
    </style>

    <!-- SweetAlert2 for confirmations -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmApprove() {
            Swal.fire({
                title: 'Approve Application?',
                text: "Are you sure you want to approve this application? This action cannot be undone.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Approve',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                background: '#f8f9fa',
                backdrop: `
                    rgba(0, 0, 0, 0.4)
                    left top
                    no-repeat
                `
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approveForm').submit();
                }
            });
        }

        function confirmReject() {
            Swal.fire({
                title: 'Reject Application?',
                text: "Are you sure you want to reject this application? Please ensure you've provided a valid reason.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Reject',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                background: '#f8f9fa',
                backdrop: `
                    rgba(0, 0, 0, 0.4)
                    left top
                    no-repeat
                `
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('rejectForm').submit();
                }
            });
        }

        function confirmOnhold() {
            Swal.fire({
                title: 'Hold Application?',
                text: "Are you sure you want to Hold this application? Please ensure you've provided a valid reason.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Hold',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                background: '#f8f9fa',
                backdrop: `
                    rgba(0, 0, 0, 0.4)
                    left top
                    no-repeat
                `
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('holdForm').submit();
                }
            });
        }function confirmRecommend() {
            Swal.fire({
                title: 'Recommend Application?',
                text: "Are you sure you want to Recomment this application? Please ensure you've provided a valid reason.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Recommend',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                background: '#f8f9fa',
                backdrop: `
                    rgba(0, 0, 0, 0.4)
                    left top
                    no-repeat
                `
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('recommendedForm').submit();
                }
            });
        }

        // Optional: Auto-resize textarea
        document.querySelector('textarea')?.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    </script>
@endsection
