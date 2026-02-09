@extends('admin.layouts.app')

@section('title', 'Upload Attachments')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">
                    <i class="bi bi-files me-2"></i>
                    Document Management
                </h4>
                <div class="badge bg-info">
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
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Upload Form: Only for users with upload permission -->
            @if(auth()->user()->hasPermission('upload_documents'))
                <div class="card border-dashed mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-cloud-arrow-up text-primary me-2"></i>
                            Upload New File
                        </h5>
                        <form action="{{ route('admin.attachments.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Choose File</label>
                                <input type="file" name="attachment" class="form-control" required>
                                <div class="form-text">Max file size: 10MB. Allowed: PDF, DOC, JPG, PNG</div>
                            </div>
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-upload me-1"></i> Upload
                            </button>
                        </form>
                    </div>
                </div>
                <hr>
            @else
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    You don't have permission to upload files. Contact an administrator.
                </div>
            @endif

            <h5 class="mb-3">
                <i class="bi bi-folder me-2"></i>
                Uploaded Files
            </h5>

            @if($attachments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
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
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi {{ $attachment->file_icon }} text-{{ $attachment->file_color }} me-2"></i>
                                        <span>{{ $attachment->original_name }}</span>
                                    </div>
                                </td>
                                <td>{{ $attachment->formatted_size }}</td>
                                <td>
                                        <span class="badge bg-{{ $attachment->is_active ? 'success' : 'secondary' }}">
                                            {{ $attachment->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                </td>
                                <td>{{ $attachment->created_at->format('M d, Y') }}</td>
                                <td>
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

                                    <!-- View/Download - All authorized roles -->
                                    <a href="#" class="btn btn-sm btn-outline-primary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox text-muted fs-1"></i>
                    <p class="text-muted mt-3">No files uploaded yet</p>
                    @if(auth()->user()->hasPermission('upload_documents'))
                        <a href="#upload-form" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Upload First File
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection

<style>
    .border-dashed {
        border: 2px dashed #dee2e6;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
    }
</style>
