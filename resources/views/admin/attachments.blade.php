@extends('admin.layouts.app')

@section('title', 'Upload Attachments')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-3 p-md-4">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-2">
                <h4 class="mb-0 fs-5 fs-md-4">
                    <i class="bi bi-files me-2"></i>
                    Document Management
                </h4>
                <div class="badge bg-info align-self-sm-center">
                    @if(auth()->user()->hasRole('Admin'))
                        Full Access
                    @elseif(auth()->user()->hasRole('Manager'))
                        View Only
                    @elseif(auth()->user()->hasRole('Staff'))
                        Limited Access
                    @endif
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success py-2">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li class="small">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Upload Form: Only for users with upload permission -->
            @if(auth()->user()->hasPermission('upload_documents'))
                <div class="card border-dashed mb-4">
                    <div class="card-body p-3">
                        <h5 class="card-title fs-6">
                            <i class="bi bi-cloud-arrow-up text-primary me-2"></i>
                            Upload New File
                        </h5>
                        <form action="{{ route('admin.attachments.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small">Choose File</label>
                                <input type="file" name="attachment" class="form-control form-control-sm" required>
                                <div class="form-text small">Max: 10MB. Allowed: PDF, DOC, JPG, PNG</div>
                            </div>
                            <button type="submit" class="btn btn-dark btn-sm w-100 w-sm-auto">
                                <i class="bi bi-upload me-1"></i> Upload
                            </button>
                        </form>
                    </div>
                </div>
                <hr class="my-4">
            @else
                <div class="alert alert-warning py-2 small">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    You don't have permission to upload files.
                </div>
            @endif

            <h5 class="mb-3 fs-6">
                <i class="bi bi-folder me-2"></i>
{{--                Uploaded Files ({{ $attachments->total() ?? $attachments->count() }})--}}
            </h5>

            @if($attachments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light d-none d-md-table-header-group">
                        <tr>
                            <th>File Name</th>
                            <th>Size</th>
                            <th>Status</th>
                            <th>Uploaded</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attachments as $attachment)
                            <tr class="d-block d-md-table-row border-bottom border-md-0 pb-2 pb-md-0 mb-2 mb-md-0">
                                <!-- Mobile layout using CSS grid -->
                                <td class="d-block d-md-table-cell border-0 pb-0 pb-md-3" data-label="File Name">
                                    <div class="d-flex align-items-center">
                                        <i class="bi {{ $attachment->file_icon }} text-{{ $attachment->file_color }} me-2 fs-5"></i>
                                        <div>
                                            <span class="fw-medium">{{ $attachment->original_name }}</span>
                                            <div class="d-block d-md-none small text-muted mt-1">
                                                <span>{{ $attachment->formatted_size }}</span> •
                                                <span class="badge bg-{{ $attachment->is_active ? 'success' : 'secondary' }} bg-opacity-10 text-{{ $attachment->is_active ? 'success' : 'secondary' }}">
                                                    {{ $attachment->is_active ? 'Active' : 'Inactive' }}
                                                </span> •
                                                <span>{{ $attachment->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">{{ $attachment->formatted_size }}</td>
                                <td class="d-none d-md-table-cell">
                                    <span class="badge bg-{{ $attachment->is_active ? 'success' : 'secondary' }}">
                                        {{ $attachment->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="d-none d-md-table-cell">{{ $attachment->created_at->format('M d, Y') }}</td>
                                <td class="d-block d-md-table-cell border-0 pt-2 pt-md-3" data-label="Actions">
                                    <div class="d-flex gap-2">
                                        <!-- Toggle Active/Inactive - Admin only -->
                                        @if(auth()->user()->hasRole('Admin'))
                                            <form action="{{ route('admin.attachments.toggle', $attachment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-{{ $attachment->is_active ? 'success' : 'secondary' }}" title="{{ $attachment->is_active ? 'Deactivate' : 'Activate' }}">
                                                    <i class="bi bi-power"></i>
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Delete - Admin only -->
                                        @if(auth()->user()->hasRole('Admin'))
                                            <form action="{{ route('admin.attachments.destroy', $attachment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile pagination -->
                @if(method_exists($attachments, 'links'))
                    <div class="mt-3">
                        {{ $attachments->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @else
                <div class="text-center py-4 py-md-5">
                    <i class="bi bi-inbox text-muted fs-1"></i>
                    <p class="text-muted mt-2">No files uploaded yet</p>
                    @if(auth()->user()->hasPermission('upload_documents'))
                        <a href="#upload-form" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle me-2"></i>
                            Upload First File
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    @push('styles')
        <style>
            .border-dashed {
                border: 2px dashed #dee2e6 !important;
            }
            @media (max-width: 767.98px) {
                .table, .table tbody, .table tr, .table td {
                    display: block;
                    width: 100%;
                }
                .table td {
                    position: relative;
                    padding-left: 10px !important;
                    padding-right: 10px !important;
                }
                .table td[data-label] {
                    text-align: left;
                }
            }
        </style>
    @endpush
@endsection
